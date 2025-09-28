@extends('admin.layouts.app')

@section('main')

    @if(session('successMessage'))
        <div id="success-alert" class="alert alert-success position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('successMessage') }}
        </div>
    @endif

    @if(session('errorMessage'))
        <div id="error-alert" class="alert alert-danger position-absolute start-0 mt-5" style="z-index: 1000;">
            {{ session('errorMessage') }}
        </div>
    @endif


    <section class="admin-dashboard">
        <div class="container">
            <div class="welcome-admin">Welcome back, <span class="admin-name">{{ auth()->user()->first_name }}</span></div>
            <div class="dashboard-header">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 text-muted">Total Users</h6>
                                    <h2 class="mb-0">{{ $userCount }}</h2>
                                    <small class="text-muted">{{$students}} Participants • {{$organizers}} Organizers •
                                        {{$admins}} Admin</small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 text-muted">Total Events</h6>
                                    <h2 class="mb-0">{{$eventCount}}</h2>
                                    <small class="text-muted">{{$approved}} Approved • {{$pending}} Pending • {{$rejected}}
                                        Rejected</small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 text-muted">Active Participants</h6>
                                    <h2 class="mb-0">{{$students}}</h2>
                                    <small class="text-muted">{{$activeParticipants}} registered for upcoming events</small>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-running"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-subtitle mb-2 text-muted">Certificates Issued</h6>
                                    <h2 class="mb-0">{{$certificateCount}}</h2>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Events by Category</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="eventsByCategory" height="300px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Event Slots Filled</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="eventSlots" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-xl-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">Pending Event Approvals</h6>
                                <a href="{{url('/admin/eventDec')}}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Category</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pendingEvents as $event)
                                                <tr>
                                                    <td>{{ $event->title }}</td>
                                                    {{-- <td>{{ $event->organizer ?? 'N/A' }}</td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($event->created_at)->format('Y-m-d') }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $event->category }}</span>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('events.approve', $event->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="action-btn approve-btn"
                                                                title="Approve">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('events.reject', $event->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="action-btn reject-btn" title="Reject">
                                                                <i class="fas fa-x"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">No pending events</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-header d-flex justify-content-between align-items-center bg-white border-0">
                                <h6 class="card-title mb-0 fw-bold">Recent Feedbacks</h6>
                                <a href="{{url('/admin/feedback')}}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Student</th>
                                                <th>Event</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($feedbacks as $feedback)
                                                <tr>
                                                    <td>{{ $feedback->user->first_name }}</td>
                                                    <td>{{ $feedback->event->title }}</td>
                                                    <td>
                                                        <span class="text-warning">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $feedback->rating)
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </span>
                                                    </td>
                                                    <td>{{ $feedback->message }}</td>
                                                    <td>
                                                        <form action="{{ route('feedback.delete', $feedback->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onsubmit="return confirm('Are you sure to delete this feedback?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger"><i
                                                                    class="fa-solid fa-trash-alt"></i>
                                                            </button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">No feedback found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">Pending Organizers Approvals</h6>
                                <a href="{{url('/viewUsers')}}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Participent Name</th>
                                                <th>Enrollment Date</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pendingparticipents as $participent)
                                                <tr>
                                                    <td>{{ $participent->first_name }}</td>
                                                    {{-- <td>{{ $event->organizer ?? 'N/A' }}</td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($participent->enrollmrnt_id)->format('Y-m-d') }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $participent->first_name }}</span>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('participents.approve', $participent->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="action-btn approve-btn"
                                                                title="Approve">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('participent.reject', $participent->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="action-btn reject-btn" title="Reject">
                                                                <i class="fas fa-x"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center text-muted">No pending events</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

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
        });



        const ctx = document.getElementById('eventsByCategory');
        const data = @json($eventsByCategory);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.map(e => e.category),
                datasets: [{
                    data: data.map(e => e.total),
                    backgroundColor: [
                        //             --lightest: #B4D9F2;
                        // --light: #6EB6E8;
                        // --medium-light: #0386D4;
                        // --medium: #0386D4;
                        // --medium-dark: #20497D;
                        // --dark: #001F48;
                        // --shadow: rgba(32, 73, 125, 0.2);
                        // --transition: all 0.3s ease;
                        '#B4D9F2', '#6EB6E8', '#0386D4',
                        '#0386D4', '#20497D', '#001F48',
                        '#20497D', '#001F48', '#001F48'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: 'Events Distribution by Category' }
                }
            }
        });

        const ctxSlots = document.getElementById('eventSlots');
        const slotsData = @json($slotsData);

        new Chart(ctxSlots, {
            type: 'bar',
            data: {
                labels: slotsData.map(e => e.title),
                datasets: [{
                    label: 'Slots Filled',
                    data: slotsData.map(e => e.slots_fulled),
                    backgroundColor: '#20497D',
                    borderColor: '#B4D9F2',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Slots Filled per Event' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection