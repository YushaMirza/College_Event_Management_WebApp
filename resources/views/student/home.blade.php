<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - College Event Management System</title>
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

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-text);
            overflow-x: hidden;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            padding: 4rem 0 5rem;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23F0F3FA" fill-opacity="0.1" d="M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,224C672,235,768,181,864,165.3C960,149,1056,171,1152,170.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: bottom;
            opacity: 0.2;
        }
        
        .hero-title {
            font-weight: 800;
            font-size: 3.1rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            font-weight: 300;
            max-width: 600px;
        }
        
        .btn-hero {
            background-color: white;
            color: var(--primary-accent);
            padding: 1rem 2.5rem;
            font-weight: 600;
            border-radius: 30px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-hero:after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: -100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s ease;
        }
        
        .btn-hero:hover {
            background-color: var(--secondary-bg);
            color: var(--dark-text);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        
        .btn-hero:hover:after {
            left: 100%;
        }
        
        .hero-image {
            position: relative;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .section-header {
            text-align: center;
            margin: 4rem 0 3rem;
            color: var(--dark-text);
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-header:after {
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
        
        .events-section {
            background-color: var(--light-bg);
            padding: 5rem 0;
            position: relative;
        }
        
        .events-section:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100px;
            top: -50px;
            left: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23F0F3FA" d="M0,128L48,117.3C96,107,192,85,288,112C384,139,480,213,576,224C672,235,768,181,864,165.3C960,149,1056,171,1152,170.7C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center;
        }
        
        .event-card {
            border-radius: 15px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
            background: white;
        }
        
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .event-img {
            height: 200px;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .event-card:hover .event-img {
            transform: scale(1.05);
        }
        
        .event-date {
            background-color: var(--primary-accent);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .event-title {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .event-detail {
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
        }
        
        .event-detail i {
            margin-right: 10px;
            color: var(--primary-accent);
        }
        
        .btn-register-event {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-register-event:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-view-all {
            background-color: white;
            color: var(--primary-accent);
            border: 2px solid var(--primary-accent);
            padding: 0.8rem 2.5rem;
            border-radius: 30px;
            margin-top: 3rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-view-all:hover {
            background-color: var(--primary-accent);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .categories-section {
            padding: 5rem 0;
            background: white;
        }
        
        .category-card {
            background: linear-gradient(135deg, white 0%, var(--light-bg) 100%);
            border-radius: 15px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            height: 100%;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .category-card:before {
            content: '';
            position: absolute;
            width: 100%;
            height: 5px;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--soft-accent), var(--primary-accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }
        
        .category-card:hover {
            border-color: var(--primary-accent);
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        
        .category-card:hover:before {
            transform: scaleX(1);
        }
        
        .category-icon {
            font-size: 3rem;
            color: var(--primary-accent);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .category-card:hover .category-icon {
            transform: scale(1.1);
            color: var(--dark-text);
        }
        
        .category-title {
            font-weight: 600;
            color: var(--dark-text);
            font-size: 1.2rem;
        }
        
        .announcements-section {
            background: linear-gradient(135deg, var(--secondary-bg) 0%, var(--light-blue) 100%);
            padding: 4rem 0;
            position: relative;
        }
        
        .announcement-container {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .announcement-container:before {
            content: '';
            position: absolute;
            width: 5px;
            height: 100%;
            left: 0;
            top: 0;
            background: linear-gradient(to bottom, var(--soft-accent), var(--primary-accent));
        }
        
        .announcement-header {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark-text);
            display: flex;
            align-items: center;
        }
        
        .announcement-header i {
            margin-right: 10px;
            color: var(--primary-accent);
            font-size: 1.8rem;
        }
        
        .announcement-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-bg);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .announcement-item:hover {
            background-color: rgba(99, 142, 203, 0.05);
            padding-left: 10px;
        }
        
        .announcement-item:last-child {
            border-bottom: none;
        }
        
        .announcement-item i {
            color: var(--primary-accent);
            margin-right: 15px;
            font-size: 1.2rem;
        }
        
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-accent);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            z-index: 1000;
        }
        
        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background-color: var(--dark-text);
            transform: translateY(-5px);
        }
        
        @media (max-width: 600px) {
            .hero-title {
                font-size: 2.1rem !important;
            }

            .hero-subtitle {
                font-size: .8rem !important;
            }

            .btn-hero {
                padding: 1rem 1.5rem !important;
                font-size: .7rem !important;
            }

            .navbar-brand {
                font-size: 1.1rem !important;
                margin-left: 0px !important;
            }
        }

        @media (max-width: 992px) {
            .hero_div{
                text-align: center !important;
            }

            .hero-subtitle{
                margin: auto auto 50px !important;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .section-header {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 1050px){
            .hero-container{
                padding: 0 50px !important;
            }
        }

        @media (max-width: 1150px){
            .hero-title {
                font-size: 2.8rem;
            }

            .hero-subtitle {
                font-size: 1rem ;
            }

            .container{
                padding: 0 23px;
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
    
    
    <section class="hero-section">
        <div class="container hero-container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero_div" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="hero-title">Discover College Events at Your Fingertips</h1>
                    <p class="hero-subtitle">EventSphere helps you find, manage, and participate in all college events from one platform. Never miss out on exciting opportunities again!</p>
                    <button class="btn btn-hero" onclick="location.href='{{route('events')}}'">Explore Events <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2069&q=80" alt="EventSphere Banner" class="img-fluid rounded-3 hero-image">
                </div>
            </div>
        </div>
    </section>

    <section class="events-section">
        <div class="container">
            <h2 class="section-header" data-aos="fade-up">Upcoming Events</h2>
            <div class="row g-4">
                @forelse($events as $event)
                @php
                $eventorganizer = $event->organizer 
                ? $event->organizer->first_name . ' ' . $event->organizer->last_name 
                : '';
                @endphp
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card event-card">
                        @if($event->media_type === 'image')
                            <img src="{{ asset($event->media_file) }}" 
                                alt="{{ $event->title }}" 
                                class="img-fluid w-100" 
                                style="height: 200px; object-fit: cover;">
                        @elseif($event->media_type === 'video')
                            <video class="img-fluid w-100" 
                                style="height: 200px; object-fit: cover;" 
                                controls 
                                @if($event->thumbnail) poster="{{ asset($event->thumbnail) }}" @endif>
                                <source src="{{ asset($event->media_file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                        <div class="card-body">
                            <span class="event-date">{{ $event->start->format('M d, Y • h:i A') }}</span>
                            <h5 class="card-title event-title">{{ $event->title }}</h5>
                            <p class="card-text event-detail"><i class="bi bi-geo-alt"></i> {{ $event->venue }}</p>
                            <p class="card-text event-detail"><i class="bi bi-tag"></i> {{ $event->category }}</p>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            <button class="btn btn-register-event btn-sm"
                                @if(auth()->check() && auth()->user()->department === 'participant' && $event->registrationOpen())
                                    data-bs-toggle="modal" data-bs-target="#registerModal{{ $event->id }}"
                                    
                                @elseif (!$event->registrationOpen())
                                    onclick="showRegistrationCLosed()"
                                @else
                                    onclick="showLoginMessage()"
                                @endif>
                                Register Now
                            </button>
                        </div>
                    </div>
                </div>
                
            <div class="modal fade" id="registerModal{{ $event->id }}" tabindex="-1" aria-labelledby="registerModalLabel{{ $event->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="registerModalLabel{{ $event->id }}">Register for {{ $event->title }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('events.register', $event->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p><strong>Event:</strong> {{ $event->title }}</p>
                                <p><strong>Description:</strong> {{ $event->description }}</p>
                                <p><strong>Venue:</strong> {{ $event->venue }}</p>
                                <p><strong>Start:</strong> {{ $event->start->format('M d, Y • h:i A') }}</p>
                                <p><strong>End:</strong> {{ $event->end->format('M d, Y • h:i A') }}</p>
                                <p><strong>Registration Deadline:</strong> {{$event->registration_deadline ? $event->registration_deadline->format('M d, Y • h:i A') : '' }}</p>
                                <p><strong>Slots Available:</strong> {{ $event->max_slots - $event->registrations()->count() }}</p>
                                <p><strong>Eligible Years:</strong> {{ $event->eligible_years }}</p>

                                <div class="mb-3">
                                    <label for="year" class="form-label">Select Your Year</label>
                                    @php
                                        $userYear = auth()->user()->year ?? '';
                                    @endphp

                                    <select name="year" id="year" class="form-select" required>
                                        <option value="">-- Select Year --</option>
                                        <option value="1" {{ $userYear === '1' ? 'selected' : '' }}>1st Year</option>
                                        <option value="2" {{ $userYear === '2' ? 'selected' : '' }}>2nd Year</option>
                                        <option value="3" {{ $userYear === '3' ? 'selected' : '' }}>3rd Year</option>
                                        <option value="4" {{ $userYear === '4' ? 'selected' : '' }}>4th Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Confirm Registration</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

                
                @empty
                    <p class="text-center text-muted">No events found.</p>
                @endforelse
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
                <button onclick="location.href='{{route('events')}}'" class="btn btn-view-all">View All Events <i class="bi bi-arrow-right ms-2"></i></button>
            </div>
        </div>
    </section>

    <section class="categories-section">
        <div class="container">
            <h2 class="section-header" data-aos="fade-up">Event Categories</h2>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="category-card">
                        <i class="bi bi-music-note-beamed category-icon"></i>
                        <h5 class="category-title">Cultural</h5>
                    </div>
                </div>
                
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="category-card">
                        <i class="bi bi-cpu category-icon"></i>
                        <h5 class="category-title">Technical</h5>
                    </div>
                </div>
                
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="category-card">
                        <i class="bi bi-trophy category-icon"></i>
                        <h5 class="category-title">Sports</h5>
                    </div>
                </div>
                
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="category-card">
                        <i class="bi bi-lightbulb category-icon"></i>
                        <h5 class="category-title">Workshops</h5>
                    </div>
                </div>
                
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="500">
                    <div class="category-card">
                        <i class="bi bi-mortarboard category-icon"></i>
                        <h5 class="category-title">Seminars</h5>
                    </div>
                </div>
                
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="600">
                    <div class="category-card">
                        <i class="bi bi-people category-icon"></i>
                        <h5 class="category-title">Social</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="announcements-section">
        <div class="container">
            <div class="announcement-container" data-aos="fade-up">
                <h3 class="announcement-header"><i class="bi bi-megaphone"></i> Latest Announcements</h3>
                
                <div class="announcement-item">
                    <i class="bi bi-info-circle"></i>
                    <strong>Tech Symposium registration extended until October 20th!</strong>
                </div>
                
                <div class="announcement-item">
                    <i class="bi-info-circle"></i>
                    <strong>New workshop added: "Introduction to AI" on October 25th</strong>
                </div>
                
                <div class="announcement-item">
                    <i class="bi-info-circle"></i>
                    <strong>Cultural Fest participant list will be published on October 10th</strong>
                </div>
                
                <div class="announcement-item">
                    <i class="bi-info-circle"></i>
                    <strong>Sports tournament schedule now available in the Events section</strong>
                </div>
            </div>
        </div>
    </section>

    @include('student.layouts.footer')

    <div class="back-to-top">
        <i class="bi bi-arrow-up"></i>
    </div>


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

        function showRegistrationCLosed() {
            const notification = document.createElement('div');
            notification.innerHTML = `
                <div class="position-fixed top-50 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header" style="background-color: var(--primary-accent); color: white;">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong class="me-auto">EventSphere</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body bg-white">
                            Registration Closed!
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        function showLoginMessage() {
            const notification = document.createElement('div');
            notification.innerHTML = `
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header" style="background-color: var(--primary-accent); color: white;">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong class="me-auto">EventSphere</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Please login or register as participant to access this feature.
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        const backToTopButton = document.querySelector('.back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('active');
            } else {
                backToTopButton.classList.remove('active');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            const announcementItems = document.querySelectorAll('.announcement-item');
            let index = 0;
            
            function showNextAnnouncement() {
                announcementItems.forEach(item => {
                    item.style.opacity = '0.7';
                });
                
                announcementItems[index].style.opacity = '1';
                announcementItems[index].style.transition = 'opacity 0.5s ease-in-out';
                
                index = (index + 1) % announcementItems.length;
            }
            
            showNextAnnouncement();
            
            setInterval(showNextAnnouncement, 3000);
        });
        
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.padding = '10px 0';
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            } else {
                navbar.style.padding = '15px 0';
                navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            }
        });
    </script>
</body>
</html>