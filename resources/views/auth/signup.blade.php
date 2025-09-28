<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EventSphere - Register</title>
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

        .eyebtn{
            top: 25px !important;
        }

        @media (max-width: 600px){
            .eyebtn {
            right: 8vw !important;
            }   

            .form-control {
                font-size: 0.8rem !important;
                padding-right: 0 !important;
            }
        }
        
        @media (max-width: 400px){
            .form-control {
                font-size: 0.7rem !important;
            }
        }

        .create-account{
            display: block !important;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            min-height: 100vh;
        }

        @media (max-width: 600px) {
            .register_full_container {
                padding: 0 25px !important;
            }
        }
        
        .register_full_container {
            padding: 0 70px;
        }
        
        .register-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            margin: 7vh auto;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--dark-text) 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        .register-body {
            padding: 30px;
        }
        
        .brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        
        .brand i {
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .welcome-text {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        .subtext {
            font-weight: 300;
            margin-bottom: 20px;
            color: #666;
            text-align: center;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-text);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .form-control {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--secondary-bg);
            margin-bottom: 15px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .form-control:focus {
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px rgba(99, 142, 203, 0.2);
        }
        
        .btn-register {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-register:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
        }
        
        .login-text {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 0.9rem;
        }
        
        .login-link {
            color: var(--primary-accent);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .login-link:hover {
            color: var(--dark-text);
            text-decoration: underline;
        }
        
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: -10px;
            margin-bottom: 15px;
            background: #eee;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        
        .feature-list li {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            background-color: var(--light-bg);
            padding: 8px 12px;
            border-radius: 20px;
        }
        
        .feature-list i {
            background-color: var(--primary-accent);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            font-size: 0.7rem;
        }

        .input-group {
        position: relative;
    }
    .toggle-password {
        position: absolute;
        right: 50px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: var(--primary-accent);
        cursor: pointer;
        font-size: 1.1rem;
        padding: 0;
    }
    .toggle-password:hover {
        color: var(--dark-text);
    }
    </style>
  	@include('student.layouts.header_css')
  
    @include('student.layouts.footer_css')
</head>
<body>

    @if(session('successMessage'))
        <div id="success-alert" class="alert alert-success position-absolute start-0" style="margin-top:200px; z-index: 1000;">
            {{ session('successMessage') }}
        </div>
    @endif

    @if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0" style="margin-top:200px; z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif
    

    @include('student.layouts.header')

    <div class="register_full_container">
        <div class="register-container">
            <div class="register-header">
                <div class="brand">
                    <i class="bi bi-calendar-event"></i> EventSphere
                </div>
                <h2 class="welcome-text">Create Your Account</h2>
            </div>
            
            <div class="register-body">
                <p class="subtext">Join our community and discover amazing events</p>
                
                <form method="POST" action="{{ route('signup') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input name="first_name" type="text" class="form-control" id="firstName" placeholder="John" required>
                            @error('first_name')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input name="last_name" type="text" class="form-control" id="lastName" placeholder="Doe" required>
                            @error('last_name')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email Address</label>
                        <input name="email" type="email" class="form-control" id="registerEmail" placeholder="name@example.com" required>
                        @error('email')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input name="phone" type="tel" class="form-control" id="phone" placeholder="+92 336 9364085" required>
                        @error('phone')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="academic_year" class="form-label">Academic Year</label>
                        <select name="year" id="academic_year" class="form-select">
                            <option value="" disabled selected>Select your academic year</option>
                            <option value="1">1st Year</option>
                            <option value="2">2nd Year</option>
                            <option value="3">3rd Year</option>
                            <option value="4">4th Year</option>
                        </select>
                        @error('academic_year')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input name="image" type="file" class="form-control" id="image" accept="image/*">
                        @error('image')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Department / Role</label>
                        <select name="department" class="form-control" id="department" required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="participant">Participant</option>
                            <option value="organizer">Organizer</option>
                            <option value="admin">Administrator</option>
                        </select>
                        @error('department')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3 position-relative">
                        <label for="registerPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control pe-5" id="registerPassword" placeholder="Create a password" required>
                            <button type="button" class="btn toggle-password eyebtn" data-target="registerPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <small style="color:red;">{{ $message }}</small>
                        @enderror
                        <div class="password-strength">
                            <div class="password-strength-bar" id="passwordStrengthBar"></div>
                        </div>
                        <small class="text-muted">Use at least 8 characters with a mix of letters, numbers & symbols</small>
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input name="password_confirmation" type="password" class="form-control pe-5" id="confirmPassword" placeholder="Confirm your password" required>
                            <button type="button" class="btn toggle-password eyebtn" data-target="confirmPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-register create-account">Create Account</button>
                </form>
                
                <ul class="feature-list">
                    <li><i class="bi bi-calendar-event"></i> Browse events</li>
                    <li><i class="bi bi-bookmark"></i> Save favorites</li>
                    <li><i class="bi bi-bell"></i> Get recommendations</li>
                    <li><i class="bi bi-award"></i> Track participation</li>
                </ul>
                
                <div class="login-text">
                    Already have an account? <a href="{{route('showlogin')}}" class="login-link">Sign in here</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            }
        });
    });

        
        const passwordInput = document.getElementById('registerPassword');
const strengthBar = document.getElementById('passwordStrengthBar');

passwordInput.addEventListener('input', function() {
    const password = passwordInput.value;
    let strength = 0;

    if (/\s/.test(password)) {
        strengthBar.style.width = "0%";
        strengthBar.style.backgroundColor = "#dc3545";
        return; // stop here
    }

    // Conditions (simplified)
    if (password.length >= 6) strength++;
    if (/[a-zA-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;

    const percent = (strength / 4) * 100;
    strengthBar.style.width = percent + "%";

    if (percent <= 25) {
        strengthBar.style.backgroundColor = "#dc3545";
    } else if (percent <= 50) {
        strengthBar.style.backgroundColor = "#fd7e14";
    } else if (percent <= 75) {
        strengthBar.style.backgroundColor = "#ffc107";
    } else {
        strengthBar.style.backgroundColor = "#198754";
    }
});

        
        const confirmPassword = document.getElementById('confirmPassword');
        
        confirmPassword.addEventListener('input', function() {
            if (confirmPassword.value !== passwordInput.value) {
                confirmPassword.setCustomValidity('Passwords do not match');
            } else {
                confirmPassword.setCustomValidity('');
            }
        });
    </script>
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