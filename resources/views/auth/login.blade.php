<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>EventSphere - Login</title>
    @include('student.layouts.links')
    <style>
        :root {
            --light-bg: #F0F3FA;
            --secondary-bg: #D5DEEF;
            --soft-accent: #8AAEE0;
            --light-blue: #B1C9EF;
            --primary-accent: #638ECB;
            --dark-text: #395886;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;    
        }
      
      .page-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 92px); /* header ki height minus karke */
}
        
        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            min-height: 500px;
        }
        
        .login-left {
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--dark-text) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-right {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-accent);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .brand i {
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .welcome-text {
            font-weight: 600;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .subtext {
            font-weight: 300;
            margin-bottom: 30px;
            color: #666;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-text);
            margin-bottom: 8px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid var(--secondary-bg);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px rgba(99, 142, 203, 0.2);
        }
        
        .btn-login {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
        }
        
        .forgot-link {
            color: var(--primary-accent);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .forgot-link:hover {
            color: var(--dark-text);
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--secondary-bg);
        }
        
        .divider-text {
            padding: 0 10px;
            color: #777;
            font-size: 0.9rem;
        }
        
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .social-btn {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid var(--secondary-bg);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            background-color: var(--light-bg);
            transform: translateY(-2px);
        }
        
        .social-icon {
            width: 20px;
            height: 20px;
        }
        
        .register-text {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .register-link {
            color: var(--primary-accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .register-link:hover {
            color: var(--dark-text);
            text-decoration: underline;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }
        
        .feature-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .feature-list i {
            background-color: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        @media (max-width: 992px) {
            .login-left {
                display: none;
            }
            .login-container {
                width: 75%;
            }
        }

        @media (max-width: 550px) {
            .login-container {
                width: 90%;
            }
          
          .brand {
            font-size: 1.4rem;
          }
        }
    </style>
  	@include('student.layouts.header_css')
  
    @include('student.layouts.footer_css')
</head>
<body>

    @if(session('successMessage'))
        <div id="success-alert" class="alert alert-success position-absolute start-0" style="margin-top: 100px; z-index: 1000;">
            {{ session('successMessage') }}
        </div>
    @endif

    @if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0" style="margin-top: 100px; z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif

    @include('student.layouts.header')
    
<div class="page-wrapper">
    <div class="login-container">
        <div class="row g-0">
            <div class="login-left col-lg-6">
                <div class="">
                    <h1 class="welcome-text mb-4">Welcome to EventSphere</h1>
                    <p>Your college event management platform. Discover, participate, and manage events all in one place.</p>
                    
                    <ul class="feature-list">
                        <li><i class="bi bi-calendar-event"></i> Browse all college events</li>
                        <li><i class="bi bi-ticket-perforated"></i> Register with one click</li>
                        <li><i class="bi bi-bell"></i> Get event reminders</li>
                        <li><i class="bi bi-award"></i> Earn participation certificates</li>
                    </ul>
                    
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-right">
                    <div class="brand mt-3">
                        <i class="bi bi-calendar-event"></i> EventSphere
                    </div>
                    <p class="subtext">Sign in to your account to continue</p>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email Address</label>
                            <input name="loginemail" type="email" class="form-control" id="loginEmail" placeholder="name@example.com">
                            @error('loginemail')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input name="loginpassword" type="password" class="form-control" id="loginPassword" placeholder="Enter your password">
                            @error('loginpassword')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-login">Sign In</button>
                    </form>
                    
                    <div class="register-text">
                        Don't have an account? <a href="{{route('showsignup')}}" class="register-link">Sign up now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="otpModalLabel">Admin OTP Verification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            @if(session('otpMessage'))
              <div class="alert alert-info">{{ session('otpMessage') }}</div>
            @endif

            <form method="POST" action="{{ route('otp.verify') }}">
                @csrf
                <div class="mb-3">
                  <label for="otpInput" class="form-label">Enter the 6-digit OTP sent to your email</label>
                  <input id="otpInput" name="otp" type="text" 
                         class="form-control @error('otp') is-invalid @enderror" 
                         maxlength="6" inputmode="numeric" pattern="\d{6}">
                  @error('otp')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                  <small class="text-muted">Didn't receive OTP? Click Regenerate.</small>
                </div>
                <button type="submit" class="btn btn-primary">Verify OTP</button>
            </form>

            <form action="{{ route('otp.regen') }}" method="POST" class="d-inline-block mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Regenerate OTP</button>
            </form>
          </div>

        </div>
      </div>
    </div>
</div>

    @if(session('showOtpModal'))
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
    otpModal.show();
  });
</script>
@endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 3000);
            }else if(errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000);
            }
        });

    </script>
</body>
</html>