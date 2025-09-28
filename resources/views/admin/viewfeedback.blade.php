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

    <section class="feedback" style="padding: 50px 0">
        <div class="container">
            <div class="page-header justify-between d-flex flex-row">
                <div>

                    <h2 class="page-title">Manage Feedback</h2>
                    <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
                </div>
                <div>
                    <button class="btn btn-outline-light anouncement"
                        onclick="location.href='{{url('/admin/notificationForm')}}'"><i class="fas fa-bullhorn me-1"></i>
                        Send Announcement</button>
                </div>
            </div>
            <div class="controls-section">
            <form action="{{ route('feeback.search') }}" method="get" class="search-box">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search User...">
                <button type="submit" class="btn btn-primary btn-sm search-btn d-flex align-items-center justify-content-center p-2" title="Search">
    <i style="color: white" class="fas fa-search"></i>
</button>
            </form>
                
         
        </div>
            <div class="destinations-table-container mb-4">
                <h4 class="mb-3">All Feedbacks</h4>
                {{-- <div class="destinations-table-container"> --}}
                    <table id="destinationsTable">
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Event Title</th>
                                <th>Rating</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feedbacks as $index => $feedback)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>

                                    <td>{{$feedback->user->first_name}}</td>
                                    <td>{{$feedback->event->title}}</td>

                                    <td>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $feedback->rating)
                                                <span style="color: gold; font-size: 18px;">&#9733;</span>
                                            @else
                                                <span style="color: #ccc; font-size: 18px;">&#9734;</span>
                                            @endif
                                        @endfor
                                    </td>
                                    <td>{{ $feedback->message }}</td>


                                    <td>
                                        <form action="{{ route('feedback.approve', $feedback->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            {{-- <button class="btn btn-sm btn-success">Approve</button> --}}
                                        </form>

                                        <form action="{{ route('feedback.delete', $feedback->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure to delete this feedback?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Add Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to add this feedback to your dashboard?
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-no" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <a href="" id="btn-yes" class="btn btn-primary">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('scripts')
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

    </script>
@endpush