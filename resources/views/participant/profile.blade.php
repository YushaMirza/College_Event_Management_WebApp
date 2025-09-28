<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - My Profile</title>
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

        .detail-value {
    user-select: none;       
    pointer-events: none;   
}
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            background-color: var(--light-bg);
        }
        
\        .profile-section {
            padding: 3rem 0;
        }
        
        .profile-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--secondary-bg);
        }
        
        .profile-picture {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--light-blue);
            cursor: pointer;
        }
        
        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-edit-icon {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: var(--primary-accent);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .profile-picture:hover .profile-edit-icon {
            background: var(--dark-text);
        }
        
        .profile-name {
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }
        
        .profile-email {
            color: #666;
        }
        
        .profile-details {
            margin-bottom: 2rem;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid var(--secondary-bg);
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: var(--dark-text);
        }
        
        .detail-value {
            color: #666;
        }
        
        .detail-actions {
            display: flex;
            gap: 10px;
            justify-content: end;
            margin-bottom: 20px;
        }
        
        .btn-edit {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-edit:hover {
            background-color: var(--dark-text);
        }
        
        .btn-password {
            background-color: white;
            color: var(--primary-accent);
            border: 2px solid var(--primary-accent);
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-password:hover {
            background-color: var(--primary-accent);
            color: white;
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-accent) 0%, var(--dark-text) 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
        }
        
        .btn-close {
            filter: invert(1);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid var(--secondary-bg);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px rgba(99, 142, 203, 0.2);
        }
        
        .form-control:disabled {
            background-color: var(--light-bg);
            color: #999;
        }
        
        .btn-save {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-save:hover {
            background-color: var(--dark-text);
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .detail-item {
                flex-direction: column;
                gap: 10px;
            }
            
            .detail-actions {
                justify-content: flex-start;
            }
        }
    </style>
    @if(auth()->user()->department === 'admin')
  	<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  	@include('student.layouts.header_css')
  @elseif(auth()->user()->department === 'participant' || auth()->user()->department === 'organizer')
  	@include('student.layouts.header_css')
  @endif
  
    @include('student.layouts.footer_css')
</head>
<body>
    @if (auth()->user()->department === 'participant' || auth()->user()->department === 'organizer')
    @include('student.layouts.header')
    @endif
    @if (auth()->user()->department === 'admin')
    @include('admin.compunents.hader')
    @endif


    @if(session('successMessage') )
        <div id="success-alert" class="alert alert-success position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('successMessage') }}
        </div>
    @endif

    @if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif
    
    <section class="profile-section hero-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="profile-picture" data-bs-toggle="modal" data-bs-target="#profilePictureModal">

                                @php
                                    $userImagePath = 'images/profile_icons/' . auth()->user()->image;
                                @endphp
                                
                                @if(auth()->user()->image && file_exists(public_path($userImagePath)))
                  
                                <img src="{{ auth()->user()->image 
                                    ? asset('images/profile_icons/' . auth()->user()->image) 
                                    : asset('images/profile_icons/default.png') }}" alt="Profile Picture">
              @else
                                <img src="{{ asset('images/profile_icons/default.png') }}" alt="Profile Picture">
            @endif
                  
                                <div class="profile-edit-icon">
                                    <i class="bi bi-pencil"></i>
                                </div>
                            </div>
                            <h2 class="profile-name">{{auth()->user()->first_name}}</h2>
                            <p class="profile-email">{{auth()->user()->email}}</p>
                        </div>
                        
                        <div class="profile-details">
                            
                            <div class="detail-actions">
                                <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editDetailsModal">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Enrollment ID</div>
                                <div class="detail-value" readonly>{{auth()->user()->enrollment_id}}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Full Name</div>
                                <div class="detail-value">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Email Address</div>
                                <div class="detail-value" readonly>{{auth()->user()->email}}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Phone Number</div>
                                <div class="detail-value">{{auth()->user()->phone}}</div>
                            </div>
                            
                            <div class="detail-item">
                                <div class="detail-label">Password</div>
                                <div class="detail-value">•••••••••</div>
                                <div class="detail-actions">
                                    <button class="btn-password" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        <i class="bi bi-key me-1"></i> Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="profilePictureModal" tabindex="-1" aria-labelledby="profilePictureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form action="{{ route('profile_image.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="profilePictureModalLabel">Update Profile Picture</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <input type="file" name="image" class="form-control" accept="image/*" required>
            @error('image')
                <small style="color:red;">{{ $message }}</small>
            @enderror
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
        </div>
    </div>
    </div>


    <div class="modal fade" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDetailsModalLabel">Edit Personal Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile_detail.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="enrollmentId" class="form-label">Enrollment ID</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->enrollment_id }}" disabled>
                        </div>
                        
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="firstName" value="{{ auth()->user()->first_name }}">
                            @error('first_name')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="lastName" value="{{ auth()->user()->last_name }}">
                            @error('last_name')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone" id="phone" value="{{ auth()->user()->phone }}">
                            @error('phone')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('profile_password.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                @error('current_password')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
                @error('new_password')
                    <small style="color:red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-save">Save Changes</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>

    @if (auth()->user()->department === 'participant' || auth()->user()->department === 'organizer')
        @include('student.layouts.footer')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        document.getElementById('profileImage').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('#profilePictureModal img').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        document.querySelector('#changePasswordModal .btn-save').addEventListener('click', function() {
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (!currentPassword || !newPassword || !confirmPassword) {
                alert('Please fill in all password fields');
                return;
            }
            
            if (newPassword !== confirmPassword) {
                alert('New passwords do not match');
                return;
            }
            
            if (newPassword.length < 8) {
                alert('New password must be at least 8 characters long');
                return;
            }
            
            alert('Password updated successfully!');
        });

        document.querySelector('#editDetailsModal .btn-save').addEventListener('click', function() {
            const fullName = document.getElementById('fullName').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            
            if (!fullName || !phone || !address) {
                alert('Please fill in all required fields');
                return;
            }
            
            document.querySelector('.profile-name').textContent = fullName;
            document.querySelectorAll('.detail-item')[1].querySelector('.detail-value').textContent = fullName;
            document.querySelectorAll('.detail-item')[3].querySelector('.detail-value').textContent = phone;
            document.querySelectorAll('.detail-item')[4].querySelector('.detail-value').textContent = address;
            
            alert('Profile details updated successfully!');
        });
    </script>
</body>
</html>