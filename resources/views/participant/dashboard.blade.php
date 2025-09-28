<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - Participant Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            background-color: var(--light-bg);
        }

        .dashboard-container {
            padding: 2rem 0;
        }

        .section-title {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-accent);
            display: inline-block;
        }

        .dashboard-card {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-accent);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 2.5rem;
            color: var(--primary-accent);
            margin-bottom: 1rem;
        }

        .card-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }

        .card-label {
            color: #666;
            font-weight: 500;
        }

        .event-card {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            margin-bottom: 1.5rem;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .event-image {
            height: 160px;
            overflow: hidden;
        }

        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .event-card:hover .event-image img {
            transform: scale(1.05);
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
            font-size: 1.2rem;
        }

        .event-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .event-location {
            display: flex;
            align-items: center;
            color: #666;
        }

        .event-location i {
            margin-right: 5px;
            color: var(--primary-accent);
        }

        .event-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-confirmed {
            background-color: #e6f7ee;
            color: #28a745;
        }

        .status-waitlist {
            background-color: #fff4e6;
            color: #fd7e14;
        }

        .status-cancelled {
            background-color: #ffe6e6;
            color: #dc3545;
        }

        .event-actions {
            display: flex;
            justify-content: space-between;
        }

        .btn-calendar {
            background-color: white;
            color: var(--primary-accent);
            border: 2px solid var(--primary-accent);
            padding: 6px 15px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-calendar:hover {
            background-color: var(--primary-accent);
            color: white;
        }

        .btn-cancel {
            background-color: white;
            color: #dc3545;
            border: 2px solid #dc3545;
            padding: 6px 15px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-cancel:hover {
            background-color: #dc3545;
            color: white;
        }

        .history-table {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:nth-child(even) {
            background-color: var(--light-bg);
        }

        .btn-download {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-download:hover {
            background-color: var(--dark-text);
        }

        .notifications-panel {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .notification-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--secondary-bg);
            display: flex;
            align-items: flex-start;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-icon {
            color: var(--primary-accent);
            font-size: 1.2rem;
            margin-right: 15px;
            margin-top: 3px;
        }

        .notification-content {
            flex: 1;
        }

        .notification-time {
            font-size: 0.8rem;
            color: #999;
            margin-top: 5px;
        }

        .feedback-section {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .star-rating {
            color: #ffc107;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .btn-submit {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: var(--dark-text);
        }

        .saved-media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 2rem;
        }

        .media-item {
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 180px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .media-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .media-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .media-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .media-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            padding: 15px;
            color: white;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .media-item:hover .media-overlay {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .card-value {
                font-size: 2rem;
            }

            .event-actions {
                flex-direction: column;
                gap: 10px;
            }

            .btn-calendar,
            .btn-cancel {
                width: 100%;
                text-align: center;
            }

            .saved-media-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .star-rating {
                display: flex;
                flex-direction: row;
            }

            .star-rating input {
                display: none;
            }

            .star-rating label {
                cursor: pointer;
                font-size: 2rem;
                color: #ccc;
                transition: color 0.3s;
            }

            .star-rating label i {
                cursor: pointer;
                font-size: 2rem;
                color: #ccc;
                transition: color 0.3s;
            }

            .star-rating i {
                font-size: 2rem;
                cursor: pointer;
                transition: color 0.2s;
            }

            .text-warning {
                color: #ffc107 !important;
            }


        }
    </style>
  	@include('student.layouts.header_css')
  
    @include('student.layouts.footer_css')
</head>

<body>
    @include('student.layouts.header')


    @if(session('successMessage'))
        <div id="success-alert" class="alert alert-success position-absolute start-0"
            style="margin-top:100px; z-index: 1000;">
            {{ session('successMessage') }}
        </div>
    @endif

    @if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0" style="margin-top:100px; z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif


    <div class="dashboard-container">
        <div class="container">
            <h2 class="section-title">Dashboard Overview</h2>
            <div class="row mb-5">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="card-value">{{$totalEventsRegistered}}</div>
                        <div class="card-label">Total Events Registered</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="card-value">{{$certificatesEarned}}</div>
                        <div class="card-label">Certificates Earned</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div class="card-value">{{$upcomingEvents}}</div>
                        <div class="card-label">Upcoming Events</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <div class="card-value">{{$feedbackSubmitted}}</div>
                        <div class="card-label">Feedback Submitted</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <h2 class="section-title">My Events</h2>
                    <div class="row">
                        @forelse($myEventRegistrations as $registration)

                            @php
                                $event = $registration->event;
                                $canCancel = $event->start > now() && $event->can_cancel === 'yes';
                                $eventStartToday = \Carbon\Carbon::parse($registration->start)->isToday();
                            @endphp

                            <div class="col-md-6 mb-4">
                                <div class="event-card">
                                    <div class="event-image">
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
                                    </div>
                                    <div class="event-content">
                                        <div class="event-date">
                                            <i class="bi bi-calendar-event"></i>
                                            {{ \Carbon\Carbon::parse($registration->start)->format('M d, Y • h:i A') }}
                                        </div>
                                        <h3 class="event-title">{{ $registration->event->title }}</h3>
                                        <div class="event-details">
                                            <div class="event-location">
                                                <i class="bi bi-geo-alt"></i> {{ $registration->event->venue }}
                                            </div>
                                            <span
                                                class="event-status {{ $registration->status === 'confirmed' ? 'status-confirmed' : 'status-waitlist' }}">
                                                {{ ucfirst($registration->status) }}
                                            </span>
                                        </div>
                                        <div class="event-actions">
                                            @php
                                                $eventEndPassed = \Carbon\Carbon::parse($registration->event->end)->isPast();
                                            @endphp
                                            @if($event->start->isToday())
                                          		@if ($registration->attended == 'yes' && $eventEndPassed)
                                                <button type="button" 
                                                        onclick="location.href='{{ route('certificate.download', $registration->id) }}'" 
                                                        class="btn btn-sm btn-primary btn-download">
                                                    <i class="bi bi-download"></i> Download Certificate
                                                </button>
                                          		@elseif ($registration->attended == 'yes')
                                                <button type="button" disabled 
                                                        class="btn btn-sm btn-success">
                                                    <i class="bi bi-check2-circle"></i> Checked In
                                                </button>
                                          		@else
                                                <button type="button" 
                                                        class="btn btn-sm btn-success" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#checkInModal{{ $event->id }}">
                                                    <i class="bi bi-check2-circle"></i> Check In
                                                </button>
                                          		@endif
                                          
                                          	@elseif ($registration->attended == 'yes' && $eventEndPassed)
                                            <button type="button" 
                                                    onclick="location.href='{{ route('certificate.download', $registration->id) }}'" 
                                                    class="btn btn-sm btn-primary btn-download">
                                                <i class="bi bi-download"></i> Download Certificate
                                            </button>
                                            @else
                                                <form action="{{ route('events.cancel', $registration->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-cancel">Cancel</button>
                                                </form>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @if($event->start->isToday())
                            <div class="modal fade" id="checkInModal{{ $event->id }}" tabindex="-1" aria-labelledby="checkInLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('events.checkin', $event->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="checkInLabel{{ $event->id }}">
                                                    Check In: {{ $event->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <p class="mb-3">
                                                    Please enter the event code provided by the organizer.
                                                </p>
                                                <input type="text" 
                                                    name="code" 
                                                    class="form-control" 
                                                    placeholder="Enter Event Code" 
                                                    required>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" 
                                                        class="btn btn-secondary" 
                                                        data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" 
                                                        class="btn btn-success">
                                                    Confirm Check In
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        
                        @endif
                        @empty
                            <p class="text-center">You have no registered events.</p>
                        @endforelse
                    </div>



                    <div class="feedback-section card shadow-sm p-4 rounded-3 mb-4">
                        <h5 class="mb-3">Leave Feedback</h5>

                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="event_id" class="form-label fw-bold">Select Event</label>
                                <select name="event_id" id="event_id" class="form-select" required>
                                    <option value="">-- Select Event --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                                    @endforeach
                                </select>
                                @error('event_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Rating</label>
                                <div class="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label>
                                            <input type="radio" name="rating" value="{{ $i }}" class="d-none">
                                            <i class="fa-regular fa-star"></i>
                                        </label>
                                    @endfor
                                </div>

                                @error('rating')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="message" class="form-label fw-bold">Your Feedback</label>
                                <textarea name="message" id="message" class="form-control" rows="3"
                                    placeholder="Share your experience..."></textarea>
                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
                        </form>
                    </div>


                    <h2 class="section-title">Saved Media</h2>
                    <div class="saved-media-grid mb-5">
                        @forelse($favourites as $fav)
                            <div class="media-item">
                                @if($fav->media_type === 'image')
                                    <img src="{{ asset('images/events/' . $fav->media_file) }}" alt="{{ $fav->media_title }}">
                                @elseif($fav->media_type === 'video')
                                    <video controls poster="{{ asset('images/events/default_poster.jpg') }}">
                                        <source src="{{ asset('videos/events/' . $fav->media_file) }}" type="video/mp4">
                                    </video>
                                @endif
                                <div class="media-overlay">
                                    <p>{{ $fav->media_title }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">No saved media yet.</p>
                        @endforelse
                    </div>

                </div>

                <div class="col-lg-4">
                    <h2 class="section-title">Profile Settings</h2>
                    <div class="notifications-panel">
                        <div class="notification-item">
                            <div class="notification-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="notification-content">
                                <h6>Update Profile</h6>
                                <p>Edit your personal information and preferences</p>
                                <button class="btn btn-sm btn-outline-primary mt-2"
                                    onclick="location.href='{{route('profile')}}'">Edit Profile</button>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="notification-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <div class="notification-content">
                                <h6>Change Password</h6>
                                <p>Update your account password for security</p>
                                <button class="btn btn-sm btn-outline-primary mt-2"
                                    onclick="location.href='{{route('profile')}}'">Change Password</button>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="notification-icon">
                                <i class="bi bi-card-image"></i>
                            </div>
                            <div class="notification-content">
                                <h6>Profile Picture</h6>
                                <p>Upload or change your profile picture</p>
                                <button class="btn btn-sm btn-outline-primary mt-2"
                                    onclick="location.href='{{route('profile')}}'">Update Picture</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('student.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
        
        
        document.addEventListener('DOMContentLoaded', function () {
            
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
    
            if (successAlert) {
                setTimeout(function () {
                    successAlert.style.display = 'none';
                }, 3000);
            } else if (errorAlert) {
                setTimeout(function () {
                    errorAlert.style.display = 'none';
                }, 3000);
            }

            
            const stars = document.querySelectorAll('.star-rating label i');

            stars.forEach((star, index) => {
                star.addEventListener('click', function () {
                    stars.forEach(s => {
                        s.classList.remove('fa-solid', 'text-warning');
                        s.classList.add('fa-regular');
                    });

                    for (let i = 0; i <= index; i++) {
                        stars[i].classList.remove('fa-regular');
                        stars[i].classList.add('fa-solid', 'text-warning');
                    }

                    document.querySelector(`input[name="rating"][value="${index + 1}"]`).checked = true;
                });
            });

            const cancelButtons = document.querySelectorAll('.btn-cancel');
            cancelButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const eventTitle = this.closest('.event-content').querySelector('.event-title').textContent;
                    if (confirm(`Are you sure you want to cancel your registration for "${eventTitle}"?`)) {
                        alert(`Your registration for "${eventTitle}" has been cancelled.`);
                    }
                });
            });
            const calendarButtons = document.querySelectorAll('.btn-calendar');
            calendarButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const eventTitle = this.closest('.event-content').querySelector('.event-title').textContent;
                    alert(`"${eventTitle}" has been added to your calendar.`);
                });
            });

            const downloadButtons = document.querySelectorAll('.btn-download');
            downloadButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const eventTitle = this.closest('tr').querySelector('td:first-child').textContent;
                    alert(`Downloading certificate for "${eventTitle}"`);
                });
            });
        });
    </script>
</body>

</html>