<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - Contact Us</title>
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
            color: var(--dark-text);
            background-color: #fff;
        }
                .contact-hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            padding: 4rem 0;
            color: white;
            text-align: center;
        }
        
        .contact-hero h1 {
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .contact-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .contact-section {
            padding: 5rem 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--dark-text);
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 80px;
            height: 4px;
            background: var(--primary-accent);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
        
        .contact-info {
            margin-bottom: 2rem;
        }
        
        .contact-icon {
            font-size: 2rem;
            color: var(--primary-accent);
            margin-bottom: 1rem;
        }
        
        .contact-detail {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
        }
        
        .contact-detail i {
            color: var(--primary-accent);
            font-size: 1.2rem;
            margin-right: 15px;
            margin-top: 5px;
        }
        
        .contact-detail-content h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .contact-detail-content p {
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
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        .btn-submit {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .btn-submit:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            height: 400px;
        }
        
        .map-container iframe {
            width: 100%;
            height: inherit;
            min-height: 300px;
            border: none;
        }

        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
        }
    </style>
    @if(auth()->check() && auth()->user()->department === 'admin')
  	<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  	@include('student.layouts.header_css')
  @else
  	@include('student.layouts.header_css')
  @endif
  
    @include('student.layouts.footer_css')
</head>
<body>
    @include('student.layouts.header')

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

    <section class="contact-hero hero-container">
        <div class="container">
            <h1>Get in Touch</h1>
            <p>Have questions or feedback? We'd love to hear from you. Reach out to us and we'll respond as soon as possible.</p>
        </div>
    </section>
    <section class="contact-section">
        <div class="container">
            <h2 class="section-title">Contact Us</h2>
            
            <div class="row g-5">
                <div class="col-lg-7" style="height: 600px;">
                    <div class="contact-card contact-form">
                        <h3 class="mb-4">Send us a Message</h3>
                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input name="name" type="text" class="form-control" id="name" placeholder="Your full name" value="{{ (auth()->user()->first_name ?? '') . ' ' . (auth()->user()->last_name ?? '') }}" required>
                                    @error('name')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Your email address" value="{{ auth()->user()->email ?? '' }}" required>
                                    @error('email')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" class="form-control" id="message" placeholder="Your message..." required></textarea>
                                @error('message')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-submit">Send Message</button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <div class="contact-info">
                        <div class="contact-detail">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div class="contact-detail-content">
                                <h4>Our Location</h4>
                                <p>123 College Avenue, Campus Road<br>New Delhi, Delhi 110001</p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-telephone-fill"></i>
                            <div class="contact-detail-content">
                                <h4>Phone Number</h4>
                                <p>+91 98765 43210<br>+91 01234 56789</p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-envelope-fill"></i>
                            <div class="contact-detail-content">
                                <h4>Email Address</h4>
                                <p>info@eventsphere.com<br>support@eventsphere.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-detail">
                            <i class="bi bi-clock-fill"></i>
                            <div class="contact-detail-content">
                                <h4>Working Hours</h4>
                                <p>Monday - Friday: 9AM - 5PM<br>Saturday: 10AM - 2PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="map-container mt-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14008.107842302753!2d77.206532!3d28.613895!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce2daa9eb4d0b%3A0x717971125923e5d!2sIndia%20Gate!5e0!3m2!1sen!2sin!4v1662347312084!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('student.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>

    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

        
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

            const contactForm = document.querySelector('.contact-form form');
            contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('.btn');
            submitBtn.textContent = 'Sending...';
            submitBtn.style.backgroundColor = '#4CAF50';
            submitBtn.style.borderColor = '#4CAF50';
                
                setTimeout(() => {
                    this.submit();
                    this.reset();
                    submitBtn.textContent = 'Send Message';
                    submitBtn.style.backgroundColor = '';
                    submitBtn.style.borderColor = '';
                }, 2000);
            });

    </script>
</body>
</html>