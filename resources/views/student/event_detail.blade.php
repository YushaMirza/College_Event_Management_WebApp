<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventSphere - AI Workshop Details</title>
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

       
        .event-details-section {
            padding: 3rem 0;
        }
        
        .event-hero {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--soft-accent) 100%);
            border-radius: 15px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
        }
        
        .event-title {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .event-caption {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
        }
        
        .event-category {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .details-card {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        
        .section-title {
            color: var(--dark-text);
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-accent);
        }
        
        .detail-item {
            display: flex;
            margin-bottom: 1.5rem;
        }
        
        .detail-icon {
            color: var(--primary-accent);
            font-size: 1.5rem;
            margin-right: 1rem;
            min-width: 30px;
        }
        
        .detail-content h5 {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 0.3rem;
        }
        
        .detail-content p {
            color: #666;
            margin-bottom: 0;
        }
        
        .progress-container {
            margin-top: 1rem;
        }
        
        .progress {
            height: 10px;
            border-radius: 5px;
            background-color: var(--secondary-bg);
            margin-bottom: 0.5rem;
        }
        
        .progress-bar {
            background-color: var(--primary-accent);
            border-radius: 5px;
        }
        
        .slots-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #666;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 2rem;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-accent);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--dark-text);
            transform: translateY(-2px);
        }
        
        .btn-outline-custom {
            background-color: white;
            color: var(--primary-accent);
            border: 2px solid var(--primary-accent);
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background-color: var(--primary-accent);
            color: white;
            transform: translateY(-2px);
        }
        
        .related-events {
            padding: 2rem 0;
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
        
        .event-card-image {
            height: 160px;
            overflow: hidden;
        }
        
        .event-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .event-card:hover .event-card-image img {
            transform: scale(1.05);
        }
        
        .event-card-content {
            padding: 1.5rem;
        }
        
        .event-card-date {
            display: flex;
            align-items: center;
            color: var(--primary-accent);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        
        .event-card-date i {
            margin-right: 8px;
        }
        
        .event-card-title {
            font-weight: 700;
            color: var(--dark-text);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .event-card-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
        
        .event-card-location {
            display: flex;
            align-items: center;
            color: #666;
        }
        
        .event-card-location i {
            margin-right: 5px;
            color: var(--primary-accent);
        }
        
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }
            
            .event-title {
                font-size: 2rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-primary-custom, .btn-outline-custom {
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

    <section class="event-details-section hero-container">
    <div class="container">

        <div class="event-hero mb-4">
            <span class="event-category">{{ $event->category }}</span>
            <h1 class="event-title">{{ $event->title }}</h1>
            <p class="event-caption">{{ $event->caption }}</p>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="details-card mb-4">
                    <h3 class="section-title">Event Details</h3>

                    <div class="detail-item mb-3">
                        <div class="detail-icon">
                            <i class="bi bi-card-text"></i>
                        </div>
                        <div class="detail-content">
                            <h5>Description</h5>
                            <p>{{ $event->description }}</p>
                        </div>
                    </div>

                    <div class="detail-item mb-3">
                        <div class="detail-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="detail-content">
                            <h5>Venue</h5>
                            <p>{{ $event->venue }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div class="detail-content">
                                    <h5>Start Date & Time</h5>
                                    <p>{{ $event->start->format('M d, Y • h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="bi bi-calendar-x"></i>
                                </div>
                                <div class="detail-content">
                                    <h5>End Date & Time</h5>
                                    <p>{{ $event->end->format('M d, Y • h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="detail-item mb-3">
                        <div class="detail-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="detail-content">
                            <h5>Registration Deadline</h5>
                            <p>{{ $event->registration_deadline ? $event->registration_deadline->format('M d, Y • h:i A') : 'Open' }}</p>
                        </div>
                    </div>

                    <div class="detail-item mb-3">
                        <div class="detail-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="detail-content">
                            <h5>Available Slots</h5>
                            <div class="progress-container mb-2">
                                @php
                                    $slotsFilled = $event->slots_fulled;
                                    $maxSlots = $event->max_slots;
                                    $percentFilled = $maxSlots > 0 ? ($slotsFilled / $maxSlots) * 100 : 0;
                                @endphp
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentFilled }}%;" aria-valuenow="{{ $percentFilled }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="slots-info d-flex justify-content-between small text-muted">
                                <span>{{ $slotsFilled }} of {{ $maxSlots }} slots filled</span>
                                <span class="ms-3">{{ $maxSlots - $slotsFilled }} available</span>
                            </div>
                        </div>
                    </div>

                    <div class="detail-item mb-3">
                        <div class="detail-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div class="detail-content">
                            <h5>Eligible Years</h5>
                            <p>{{ $event->eligible_years ?? 'All Years' }}</p>
                        </div>
                    </div>
                    <div class="action-buttons mt-3">
                        <button type="button" class="btn btn-primary me-2"
                            @if(auth()->check() && auth()->user()->department === 'participant' && $event->registrationOpen())
                                data-bs-toggle="modal" data-bs-target="#registerModal{{ $event->id }}"
                            @else
                                onclick="showLoginMessage()"
                            @endif>
                            Register for Event
                        </button>


                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="details-card mb-4">
                    <h3 class="section-title">Event Timeline</h3>
                    <div class="detail-item mb-2">
                        <div class="detail-icon"><i class="bi bi-plus-circle"></i></div>
                        <div class="detail-content">
                            <h5>Created At</h5>
                            <p>{{ $event->created_at->format('M d, Y • h:i A') }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <div class="detail-content">
                            <h5>Last Updated</h5>
                            <p>{{ $event->updated_at->format('M d, Y • h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="details-card mb-4">
                    <h3 class="section-title">Organizer Information</h3>
                    <div class="detail-item mb-2">
                        <div class="detail-icon"><i class="bi bi-person"></i></div>
                        <div class="detail-content">
                            <h5>Organizer</h5>
                            <p>{{ $event->organizer->first_name ?? '' }} {{ $event->organizer->last_name ?? '' }}</p>
                        </div>
                    </div>
                    <div class="detail-item mb-2">
                        <div class="detail-icon"><i class="bi bi-envelope"></i></div>
                        <div class="detail-content">
                            <h5>Contact Email</h5>
                            <p>{{ $event->organizer->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon"><i class="bi bi-telephone"></i></div>
                        <div class="detail-content">
                            <h5>Contact Phone</h5>
                            <p>{{ $event->organizer->phone ?? 'N/A' }}</p>
                        </div>
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
                                <p><strong>Registration Deadline:</strong> {{ $event->registration_deadline->format('M d, Y • h:i A') }}</p>
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

        <div class="related-events mt-5">
    <h3 class="section-title">Related Events</h3>
    <div class="row">
        @foreach($relatedEvents as $relEvent)
            <div class="col-md-4 mb-3">
                <div class="event-card shadow-sm border rounded overflow-hidden h-100">
                    <img src="{{ asset('images/events/' . ($relEvent->media_file ?? 'default.jpg')) }}" 
                         alt="{{ $relEvent->title ?? 'Event' }}" 
                         style="width: 100%; height: auto; object-fit: cover;">

                    <div class="small text-muted mb-1 mt-2">
                        <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($relEvent->start)->format('M d, Y') }}
                    </div>
                    <h5>{{ $relEvent->title }}</h5>
                    <div class="text-muted small">
                        <i class="bi bi-geo-alt"></i> {{ $relEvent->venue }}
                    </div>
                    <a href="{{ route('event_detail', $relEvent->id) }}" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                </div>
            </div>
        @endforeach
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
            const registerButton = document.querySelector('.btn-primary-custom');
            registerButton.addEventListener('click', function() {
                alert('You are being redirected to the registration page for the AI Workshop.');
            });
            
            const calendarButton = document.querySelector('.btn-outline-custom');
            calendarButton.addEventListener('click', function() {
                alert('AI Workshop has been added to your calendar.');
            });
            
            const viewDetailsButtons = document.querySelectorAll('.event-card .btn');
            viewDetailsButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const eventTitle = this.closest('.event-card-content').querySelector('.event-card-title').textContent;
                    alert(`You are being redirected to the details page for: ${eventTitle}`);
                });
            });
            
            setTimeout(function() {
                const progressBar = document.querySelector('.progress-bar');
                progressBar.style.width = '0%';
                
                let width = 0;
                const interval = setInterval(function() {
                    if (width >= 0) {
                        progressBar.style.width = width + '%';
                        width += 0.5;
                    } else {
                        clearInterval(interval);
                    }
                }, 10);
            }, 500);
        });
    </script>
</body>
</html>