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
<section class="media" style="padding: 50px 0">
<div class="container">
    <div class="page-header justify-between d-flex flex-row">
        <div>
            
            <h2 class="mb-3">Events List</h2>
                <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
            </div>
            <div>
                <button class="btn btn-outline-light anouncement" onclick="location.href='{{url('/admin/notificationForm')}}'"><i class="fas fa-bullhorn me-1"></i> Send Announcement</button>
            </div>
        </div>
           <div class="controls-section">
            <form action="{{ route('event.search') }}" method="get" class="search-box">
                <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="Search User...">
                <button type="submit" class="btn btn-primary btn-sm search-btn d-flex align-items-center justify-content-center p-2" title="Search">
    <i style="color: white" class="fas fa-search"></i>
</button>
            </form>
                
         
        </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

            <div class="destinations-table-container mb-4">
                <h4 class="mb-3">Media And Uploads</h4>
                        <table class="destinationsTable">
            <thead class="">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Media</th>
                    <th>Caption</th>
                    <th>Category</th>
                    <th>Venue</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @php
              
              @endphp
                @foreach($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->title }}</td>
                    <td class="text-center">
                        @if($event->media_type === 'image')
                            <img src="{{ asset($event->media_file) }}" 
                                alt="{{ $event->title }}"
                                style="height: 100px; object-fit: cover;">
                        @elseif($event->media_type === 'video')
                            <video
                                style="height: 100px; object-fit: cover;" 
                                controls 
                                @if($event->thumbnail) poster="{{ asset($event->thumbnail) }}" @endif>
                                <source src="{{ asset($event->media_file) }}" type="video/mp4">
                            </video>
                        @endif
                    </td>
                    <td>{{ $event->caption }}</td>
                    <td>{{ $event->category }}</td>
                    <td>{{ $event->venue }}</td>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->end }}</td>
                    <td>
                        <form action="{{ url('/admin/media/delete', $event->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('get')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</section>
@endsection
@push('scripts')
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
@endpush