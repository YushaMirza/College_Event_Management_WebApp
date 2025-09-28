<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;

class ContactController extends Controller
{
    public function submitMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create($request->only('name', 'email', 'message'));

        require base_path('vendor/autoload.php');
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'yousha.mirza328@gmail.com'; 
            $mail->Password   = 'garofwmqaujqwufq'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom($request->email, $request->name);
            $mail->addAddress('yousha.mirza328@gmail.com', 'Yusha Mirza');

            $mail->isHTML(true);
            $mail->Subject = 'EventSphere Contact Form Message';
            $mail->Body    = "<b>Name:</b> {$request->name}<br>
                              <b>Email:</b> {$request->email}<br>
                              <b>Message:</b><br>{$request->message}";

            $mail->send();

            return redirect()->back()->with('successMessage', 'Message sent sucessfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('errorMessage', 'Failed to send message.');
        }
    }
}
