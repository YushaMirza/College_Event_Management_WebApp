<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - Events</title>
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
        
        .events-hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            padding: 4rem 0;
            color: white;
            text-align: center;
        }
        
        .events-hero h1 {
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .events-hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .events-section {
            padding: 5rem 0;
            background-color: var(--light-bg);
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
        
        .filter-section {
            background-color: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 3rem;
        }
        
        .filter-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-text);
        }
        
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .filter-btn {
            background-color: var(--light-bg);
            color: var(--dark-text);
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .filter-btn:hover, .filter-btn.active {
            background-color: var(--primary-accent);
            color: white;
        }
        
        .event-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 2rem;
        }
        
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .event-image {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .event-card:hover .event-image img {
            transform: scale(1.1);
        }
        
        .event-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--primary-accent);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .event-content {
            padding: 1.5rem;
        }
        
        .event-date {
            display: flex;
            align-items: center;
            color: var(--primary-accent);
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .event-date i {
            margin-right: 8px;
        }
        
        .event-title {
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
        
        .event-description {
            color: #666;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        
        .event-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        
        .event-location, .event-organizer {
            display: flex;
            align-items: center;
            color: #666;
        }
        
        .event-location i, .event-organizer i {
            margin-right: 5px;
            color: var(--primary-accent);
        }
        
        .event-actions {
            display: flex;
            justify-content: space-between;
        }
        
        .btn-view-details {
            background-color: white;
            color: var(--primary-accent);
            border: 2px solid var(--primary-accent);
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-view-details:hover {
            background-color: var(--primary-accent);
            color: white;
        }
        
        .btn-register-event {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-register-event:hover {
            background-color: var(--dark-text);
        }
        
        .events-pagination {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }
        
        .page-link {
            color: var(--primary-accent);
            border: 1px solid var(--secondary-bg);
            padding: 10px 18px;
            margin: 0 5px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .page-link:hover {
            background-color: var(--primary-accent);
            color: white;
            border-color: var(--primary-accent);
        }
        
        .page-link.active {
            background-color: var(--primary-accent);
            color: white;
            border-color: var(--primary-accent);
        }

        .filter-section form .form-control,
        .filter-section form .form-select {
            border-radius: 30px;
            padding: 10px 15px;
        }
        .filter-section button {
            border-radius: 30px;
        }
        
        @media (max-width: 768px) {
            .events-hero h1 {
                font-size: 2.5rem;
            }
            
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .event-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn-view-details, .btn-register-event {
                width: 100%;
                text-align: center;
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
    

    <section class="events-hero hero-container">
        <div class="container">
            <h1>Discover Amazing Events</h1>
            <p>Find and register for events that match your interests and expand your horizons</p>
        </div>
    </section>

    <section class="events-section">
        <div class="container">
            <h2 class="section-title">Upcoming Events</h2>
            
            <div class="filter-section">
                <form method="GET" action="{{ route('events') }}" class="row g-3 align-items-center">
                
                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" 
                            placeholder="Search events..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Events</option>
                            <option value="Technical" {{ request('category') == 'Technical' ? 'selected' : '' }}>Technical</option>
                            <option value="Cultural" {{ request('category') == 'Cultural' ? 'selected' : '' }}>Cultural</option>
                            <option value="Competition" {{ request('category') == 'Competition' ? 'selected' : '' }}>Competition</option>
                            <option value="Meetup" {{ request('category') == 'Meetup' ? 'selected' : '' }}>Meetups</option>
                            <option value="Sport" {{ request('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Workshop" {{ request('category') == 'Workshop' ? 'selected' : '' }}>Workshops</option>
                            <option value="Seminar" {{ request('category') == 'Seminars' ? 'selected' : '' }}>Seminars</option>
                            <option value="Conference" {{ request('category') == 'Conference' ? 'selected' : '' }}>Conferences</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-register w-100">Apply</button>
                    </div>
                </form>
            </div>
            
    <div class="row g-4">
        @forelse($events as $event)
            @php
            $eventorganizer = $event->organizer 
            ? $event->organizer->first_name . ' ' . $event->organizer->last_name 
            : '';
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="event-card shadow-sm border rounded overflow-hidden h-100 d-flex flex-column">

                    <div class="position-relative">
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

                        <div class="position-absolute bg-primary text-white px-2 py-1 rounded-pill small fw-semibold shadow-sm" 
                            style="font-size: 0.7rem; top: 15px; right: 15px;">
                            {{ $event->category }}
                        </div>
                    </div>



                    <div class="p-3 flex-grow-1 d-flex flex-column">
                        <h5 class="event-title mb-2">{{ $event->title }}</h5>
                        <p class="event-description text-muted mb-2" style="flex-grow:1;">
                            {{ Str::limit($event->description, 100) }}
                        </p>

                        <ul class="list-unstyled mb-3 small text-secondary">
                            <li><i class="bi bi-calendar-event"></i> {{ $event->start->format('M d, Y • h:i A') }} - {{ $event->end->format('h:i A') }}</li>
                            <li><i class="bi bi-clock"></i> Register by: {{ $event->registration_deadline ? $event->registration_deadline->format('M d, Y • h:i A') : 'Open' }}</li>
                            <li><i class="bi bi-geo-alt"></i> {{ $event->venue }}</li>
                            <li><i class="bi bi-people"></i> Seats left: {{ $event->max_slots - $event->slots_fulled }}</li>
                            <li><i class="bi bi-person"></i> {{ $eventorganizer ?? '' }}</li>
                        </ul>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="{{ route('event_detail', $event->id) }}" class="btn btn-outline-primary btn-sm">
                                View Details
                            </a>

                            <button class="btn btn-register-event btn-sm"
                                @if(auth()->check() && auth()->user()->department === 'participant' && $event->registrationOpen())
                                    data-bs-toggle="modal" data-bs-target="#registerModal{{ $event->id }}"
                                    
                                @elseif (!$event->registrationOpen())
                                    onclick="showRegistrationCLosed()"
                                @else
                                    onclick="showLoginMessage()"
                                @endif>
                                Register
                            </button>
                        </div>
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
                <div class="position-fixed top-50 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header" style="background-color: var(--primary-accent); color: white;">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong class="me-auto">EventSphere</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body bg-white">
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
        
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    
                    button.classList.add('active');
                    
                    console.log('Filtering by: ' + button.textContent);
                });
            });
            
        });
    </script>
</body>
</html>