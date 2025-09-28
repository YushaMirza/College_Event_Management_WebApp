<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
{
    $incomingFields = $request->validate([
        'loginemail' => ['required', 'email'],
        'loginpassword' => ['required', 'min:8', 'max:200']
    ]);

    // user record fetch karo
    $user = \App\Models\User::where('email', $incomingFields['loginemail'])->first();

    if ($user && \Hash::check($incomingFields['loginpassword'], $user->password)) {

        // Check status first
        if ($user->status === 'pending') {
            return back()->with('errorMessage', 'Your account is pending approval. Please wait for admin approval.');
        }

        if ($user->status === 'suspend') {
            return back()->with('errorMessage', 'Your account is suspended. Contact admin.');
        }

        // Participant
        if ($user->department === 'participant') {
    Auth::login($user);
    $request->session()->regenerate();
    return redirect()->route('participant_dashboard')->with('successMessage', 'Logged in successfully!');
}
elseif ($user->department === 'organizer' && $user->status === 'active') {
    Auth::login($user);
    $request->session()->regenerate();
    return redirect("/organizer/dashboard")->with('successMessage', 'Logged in successfully!');
}
elseif ($user->department === 'admin') {
  session(['pending_admin_id' => $user->id]);

    $this->generateAndSendOtp($request, $user->email);

    return back()->with([
        'showOtpModal' => true,
        'otpMessage' => 'An OTP has been sent to your email. Please enter it to continue.'
    ]);
    // return redirect('/admin/dashboard');
}
else {
    return redirect("/")->with('error', 'Your account is not active or recognized.');
}

    }

    return back()->with('errorMessage', 'Invalid username or password.');
}


    // Verify OTP
    public function verifyOtp(Request $request)
{
    $data = $request->validate([
        'otp' => ['required', 'digits:6']
    ]);

    $sessionOtp = session('admin_otp.value');
    $expiresAt = session('admin_otp.expires_at');
    $pendingAdminId = session('pending_admin_id');

    if (!$sessionOtp || !$expiresAt || !$pendingAdminId) {
        return back()->withErrors(['otp' => 'No OTP found. Please login again.']);
    }

    if (Carbon::now()->greaterThan(Carbon::parse($expiresAt))) {
        session()->forget(['admin_otp', 'pending_admin_id']);
        return back()->withErrors(['otp' => 'OTP has expired. Please login again.']);
    }

    if ($data['otp'] === $sessionOtp) {
        // OTP matched -> clear session
        session()->forget(['admin_otp', 'pending_admin_id', 'showOtpModal', 'otpMessage']);

        // Login the pending admin
        $user = \App\Models\User::find($pendingAdminId);

        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('admin_dashboard')->with('successMessage', 'Logged in successfully!');
        }

        return back()->withErrors(['otp' => 'User not found.']);
    }

    return back()->withErrors(['otp' => 'Invalid OTP.'])->with('showOtpModal', true);
}

    // Regenerate OTP (resend)
    public function regenOtp(Request $request)
{
    $user = Auth::user();

    $pendingAdminId = session('pending_admin_id');
    if (!$pendingAdminId) {
        return back()->with('errorMessage', 'Session expired. Please login again.');
    }

    $user = \App\Models\User::find($pendingAdminId);
    if (!$user || $user->department !== 'admin') {
        return back()->with('errorMessage', 'Unauthorized.');
    }

    // Generate and send new OTP
    $this->generateAndSendOtp($request, $user->email);

    return back()->with([
        'showOtpModal' => true, // ✅ force modal reopen
        'otpMessage' => 'A new OTP has been sent to your email.'
    ]);
}

    // Helper: generate OTP and send email using PHPMailer
    protected function generateAndSendOtp(Request $request, string $toEmail)
    {
        // Generate a secure random 6-digit OTP
        try {
            $otp = (string) random_int(100000, 999999);
        } catch (\Exception $e) {
            $otp = substr((string) time(), -6); // fallback
        }

        // expiry time: 5 minutes from now
        $expiresAt = Carbon::now()->addMinutes(5)->toDateTimeString();

        // Save OTP in session (server-side)
        session([
            'admin_otp' => [
                'value' => $otp,
                'expires_at' => $expiresAt,
            ]
        ]);

        // Send OTP by email using PHPMailer
        // IMPORTANT: use env variables in production instead of hard-coded credentials.
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = config('mail.mailers.smtp.host', 'smtp.gmail.com'); // or env('MAIL_HOST')
            $mail->SMTPAuth   = true;
            $mail->Username   = config('mail.mailers.smtp.username', 'youremail@example.com'); // set in .env
            $mail->Password   = config('mail.mailers.smtp.password', 'your_email_password');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = config('mail.mailers.smtp.port', 465);

            // Sender & recipient
            $mail->setFrom(config('mail.from.address', 'no-reply@example.com'), config('mail.from.name', 'EventSphere'));
            $mail->addAddress($toEmail);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your EventSphere Admin OTP';
            $mail->Body    = "
                <p>Hello,</p>
                <p>Your one-time verification code (OTP) for EventSphere admin login is:</p>
                <h2 style='letter-spacing:4px;'>{$otp}</h2>
                <p>This code expires in 5 minutes.</p>
                <p>If you did not request this, please secure your account.</p>
            ";

            $mail->send();

            // Optionally flash message (but we also set showOtpModal in controller)
            // session()->flash('otpSent', true);
        } catch (PHPMailerException $e) {
            // If mail fails, remove OTP from session to avoid confusion
            session()->forget('admin_otp');

            // Log the error in real app; for now rethrow or handle gracefully
            // throw $e;
            // We'll simply flash error message
            session()->flash('errorMessage', 'Failed to send OTP email. Please try again later.');
        }
    }


    public function generateEnrollment()
    {
        return "ENR" . substr(time(), -6);
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'first_name' => ['required', 'min:3', 'max:15'],
            'last_name' => ['required', 'min:3', 'max:15'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'image' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'department' => ['required', 'in:participant,organizer,admin'], 
            'password' => ['required', 'min:8', 'max:200', 'confirmed','regex:/^\S*$/u'],
        ]);

        $department = $request->department;

        if ($department === 'admin') {
            $adminExists = \App\Models\User::where('department', 'admin')->exists();

            if ($adminExists) {
                return back()->with('errorMessage', 'Admin signup is no longer available.');
            }
        }

        if ($department === 'organizer') {
            $status = 'pending';
            $incomingFields['status'] = $status;
        }else{
        $status = 'active';
        $incomingFields['status'] = $status;
        }

        if ($request->department === 'participant') {
            $incomingFields['year'] = $request->year ?? '-';
        } else {
            $incomingFields['year'] = '-';
        }

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $incomingFields['enrollment_id'] = $this->generateEnrollment();

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('images/profile_icons'), $imageName);

            $incomingFields['image'] = $imageName;
        }

        // if ($incomingFields['department'] === 'admin') {
        //         $user = User::create($incomingFields);
        //         return redirect()->route('showlogin')->with('successMessage', 'Admin account created! Please log in.');
        // }

        $user = User::create($incomingFields);

        if ($department === 'admin') {
            return redirect()->route('showlogin')->with('successMessage', 'You are the first admin. Further admin signups are disabled.');
        }

        return redirect()->route('showlogin')->with('successMessage', 'Registration successful!');
    }




    public function logout() {
        if (auth()->check()) {
            auth()->logout();
            return redirect('/login');
        }
    }
}
