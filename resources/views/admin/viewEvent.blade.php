@extends('admin.layouts.app')

@section('main')



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



<section class="viewEvent" style="padding: 70px 0">
    <div class="container">
        <div class="page-header justify-between d-flex flex-row">
            <div>
                
                <h2 class="page-title">View Event Description</h2>
                <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
            </div>
            <div>
                <button class="btn btn-outline-light anouncement" onclick="location.href='{{url('/admin/notificationForm')}}'"><i class="fas fa-bullhorn me-1"></i> Send Announcement</button>
                
            </div>
            
        </div>
             <div class="controls-section">
            <form action="{{ route('eventdata.search') }}" method="get" class="search-box">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search User...">
                <button type="submit" class="btn btn-primary btn-sm search-btn d-flex align-items-center justify-content-center p-2" title="Search">
    <i style="color: white" class="fas fa-search"></i>
</button>
            </form>
                
         
        </div>
 <div class="destinations-table-container mb-4">
                <h4 class="mb-3">All Events</h4>
           
            <table id="destinationsTable" class="table align-middle">
                <thead class="text-center">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Venue</th>
                        <th>Start Date</th>
                        <th>Slots Filled</th>
                        <th>Max Slots</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>View</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $index => $event)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->category }}</td>
                            <td>{{ $event->venue }}</td>
                            <td>{{ $event->start }}</td>
                            <td>{{ $event->slots_fulled }}</td>
                            <td>{{ $event->max_slots }}</td>
                            <td>
                                @if($event->status === 'pending')
                                    <span">Pending</span>
                                @elseif($event->status === 'approved')
                                        <span>Approved</span>
                                    @elseif($event->status === 'rejected')
                                        <span>Rejected</span>
                                    @endif
                            </td>
                            <td>
                                @if($event->status === 'pending')
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#statusModal{{ $event->id }}">
                                        Change Status
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm" disabled>
                                        Status Finalized
                                    </button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/report/view' , $event->id )}}" class="btn btn-info view-report"
                                    data-id="{{ $event->id }}">
                                    View Report
                                </a>
                            </td>

                        </tr>

                        <div class="modal fade" id="statusModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Review Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to approve or reject this event?</p>
                                        <form action="{{ route('events.approve', $event->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>

                                        <form action="{{ route('events.reject', $event->id) }}" method="POST"
                                            style="margin-top:10px;">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="reason{{ $event->id }}">Reason for Rejection:</label>
                                                <textarea name="rejection_reason" id="reason{{ $event->id }}"
                                                    class="form-control" rows="2" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </section>

@endsection
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


    
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.view-report').forEach(btn => {
            btn.addEventListener('click', function () {
                let eventId = this.dataset.id;
                fetch(`/event/${eventId}/report`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('eventTitle').textContent = data.event.title;
                        document.getElementById('totalSlots').textContent = data.totalSlots;
                        document.getElementById('slotsFulled').textContent = data.slotsFulled;
                        document.getElementById('participations').textContent = data.participations;
                        document.getElementById('userGrowth').textContent = data.userGrowth;
                        document.getElementById('avgRating').textContent = data.avgRating;

                        let feedbackList = document.getElementById('feedbackList');
                        feedbackList.innerHTML = "";
                        data.feedbacks.forEach(fb => {
                            feedbackList.innerHTML += `<li>${fb.message} (Rating: ${fb.rating ?? 'N/A'})</li>`;
                        });

                        if (data.slotsFulled >= data.totalSlots) {
                            document.getElementById('certificateMsg').innerText = "All slots filled - Certificates Issued ✅";
                        } else {
                            document.getElementById('certificateMsg').innerText = "";
                        }

                        document.getElementById('downloadReport').setAttribute('href', `/event/${eventId}/download-report`);

                        new bootstrap.Modal(document.getElementById('reportModal')).show();
                    });
            });
        });
    });
</script>