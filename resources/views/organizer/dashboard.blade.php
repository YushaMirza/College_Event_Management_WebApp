<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard</title>
    @include('student.layouts.links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @php
        $palette = ['#F0F3FA', '#D5DEEF', '#8AAEE0', '#B1C9EF', '#638ECB', '#395886'];
    @endphp
    <style>
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        body {
            background:
                {{$palette[0]}}
            ;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .modal.show .modal-dialog {
            transform: none;
            background-color: white;
            border-radius: 15px;
        }

        h2 {
            font-weight: 700;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .table thead {
            background:
                {{$palette[1]}}
            ;
        }

        .table th {
            text-transform: uppercase;
            font-size: 0.85rem;
            color:
                {{$palette[5]}}
            ;
        }

        .table td {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4em 0.75em;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-primary-custom {
            background:
                {{$palette[4]}}
            ;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            border: none;
            transition: background 0.2s ease;
        }

        .btn-primary-custom:hover {
            background:
                {{$palette[5]}}
            ;
        }

        .modal-header {
            background:
                {{$palette[5]}}
            ;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid
                {{$palette[1]}}
            ;
        }

        .form-control:focus {
            border-color:
                {{$palette[4]}}
            ;
            box-shadow: 0 0 0 3px rgba(99, 142, 203, 0.2);
        }

        label {
            font-weight: 600;
            color:
                {{$palette[5]}}
            ;
        }
    </style>
  	@include('student.layouts.header_css')
  
    @include('student.layouts.footer_css')
</head>

<body>
    @include('student.layouts.header')
    <div class="container py-5">
        <div class="d-flex justify-content-between mb-4">
            <h2 style="color:{{$palette[5]}};">Organizer Dashboard</h2>
            <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#createEventModal">
                + Create Event
            </button>
        </div>

        @if(session('successMessage'))
            <div id="success-alert" class="alert alert-success position-absolute start-0"
                style="margin-top:100px; z-index: 1000;">
                {{ session('successMessage') }}
            </div>
        @endif

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <div style="color:{{$palette[5]}}; font-size:0.9rem;">Upcoming</div>
                    <h3 style="color:{{$palette[4]}}">{{$counts['upcoming']}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <div style="color:{{$palette[5]}}; font-size:0.9rem;">Ongoing</div>
                    <h3 style="color:{{$palette[4]}}">{{$counts['ongoing']}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <div style="color:{{$palette[5]}}; font-size:0.9rem;">Completed</div>
                    <h3 style="color:{{$palette[4]}}">{{$counts['completed']}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <div style="color:{{$palette[5]}}; font-size:0.9rem;">Registrations</div>
                    <h3 style="color:{{$palette[4]}}">{{$counts['registrations']}}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card text-center">
                    <div style="color:{{$palette[5]}}; font-size:0.9rem;">Feedbacks</div>
                    <h3 style="color:{{$palette[4]}}">{{$counts['feedbacks']}}</h3>
                </div>
            </div>
        </div>


        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <table class="table table-hover align-middle shadow-sm rounded-3 overflow-hidden">
                    <thead class="text-uppercase fw-bold"
                        style="background: {{ $palette[1] }}; color: {{ $palette[5] }};">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Deadline</th>
                            <th>Venue</th>
                            <th>Slots</th>
                            <th>Registered</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                                            <tr>
                                                <td class="fw-semibold">{{ $event->title }}</td>
                                                <td><span class="badge bg-secondary">{{ $event->category }}</span></td>
                                                <td>{{ $event->start->format('M d, Y H:i') }}</td>
                                                <td>{{ $event->end->format('M d, Y H:i') }}</td>
                                                <td>{{ $event->registration_deadline?->format('M d, Y H:i') ?? '—' }}</td>
                                                <td>{{ $event->venue }}</td>
                                                <td>{{ $event->max_slots }}</td>
                                                <td>
                                                    <span class="badge bg-info text-dark">{{ $event->registrations_count }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill px-3 py-2 
                                        {{ $event->status == 'approved'
                            ? 'bg-success'
                            : ($event->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                                        {{ ucfirst($event->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        @if($event->status == 'approved')
                                                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#editEventModal{{ $event->id }}" title="Edit Event">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>
                                                        @endif

                                                        <button class="btn btn-outline-danger btn-sm"
                                                            onclick="confirmCancel('{{ $event->id }}')" title="Cancel Event">
                                                            <i class="bi bi-x-circle"></i>
                                                        </button>

                                                        <form action="{{ route('events.generate_certificate', $event->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-warning btn-sm"
                                                                title="Generate Certificates">
                                                                <i class="bi bi-file-earmark-medical"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('organizer.events.update', $event->id) }}" method="POST"
                                                            enctype="multipart/form-data" class="modal-content shadow-lg rounded-3">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header bg-light">
                                                                <h5 class="modal-title">Edit Event: {{ $event->title }}</h5>
                                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Title</label>
                                                                        <input type="text" name="title" class="form-control"
                                                                            value="{{ $event->title }}" required>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Category</label>
                                                                        <select name="category" class="form-select" required>
                                                                            @foreach(['Technical', 'Cultural', 'Meetup', 'Sport', 'Workshop', 'Seminar', 'Conference', 'Competition'] as $cat)
                                                                                <option value="{{ $cat }}" {{ $event->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Description</label>
                                                                        <textarea name="description" class="form-control" rows="3"
                                                                            required>{{ $event->description }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Venue</label>
                                                                        <input type="text" name="venue" class="form-control"
                                                                            value="{{ $event->venue }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Max Slots</label>
                                                                        <input type="number" name="max_slots" class="form-control"
                                                                            value="{{ $event->max_slots }}" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Start</label>
                                                                        <input type="datetime-local" name="start" class="form-control"
                                                                            value="{{ $event->start->format('Y-m-d\TH:i') }}" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">End</label>
                                                                        <input type="datetime-local" name="end" class="form-control"
                                                                            value="{{ $event->end->format('Y-m-d\TH:i') }}" required>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label class="form-label">Registration Deadline</label>
                                                                        <input type="datetime-local" name="registration_deadline"
                                                                            class="form-control"
                                                                            value="{{ $event->registration_deadline?->format('Y-m-d\TH:i') }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Can Cancel</label>
                                                                        <select name="can_cancel" class="form-select">
                                                                            <option value="no" {{ $event->can_cancel == 'no' ? 'selected' : '' }}>
                                                                                No</option>
                                                                            <option value="yes" {{ $event->can_cancel == 'yes' ? 'selected' : '' }}>Yes</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Eligible Years</label>
                                                                        <input type="text" name="eligible_years" class="form-control"
                                                                            value="{{ $event->eligible_years }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Event Code</label>
                                                                        <input type="text" name="code" class="form-control"
                                                                            value="{{ $event->code }}">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label class="form-label">Media</label>
                                                                        <input type="file" name="media_file" class="form-control">
                                                                        @if($event->media_file)
                                                                            <small class="text-muted">Current: {{ $event->media_file }}</small>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label class="form-label">Caption</label>
                                                                        <input type="text" name="caption" class="form-control"
                                                                            value="{{ $event->caption }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer bg-light">
                                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No events yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="createEventModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form action="{{route('organizer.events.store')}}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Event</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label>Title</label>
                            <input name="title" class="form-control" required>
                            @error('title')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>Category</label>
                            <select name="category" class="form-control" required>
                                <option>Technical</option>
                                <option>Cultural</option>
                                <option>Meetup</option>
                                <option>Sport</option>
                                <option>Workshop</option>
                                <option>Seminar</option>
                                <option>Conference</option>
                                <option>Competition</option>
                            </select>
                            @error('category')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12"><label>Description</label><textarea name="description" class="form-control" required></textarea>
                            @error('description')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-6"><label>Venue</label><input name="venue" class="form-control">
                            @error('venue')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-6"><label>Max Slots</label><input type="number" name="max_slots" class="form-control" value="100" required>
                            @error('max_slots')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-4"><label>Start</label><input type="datetime-local" name="start" class="form-control" required>
                            @error('start')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-4"><label>End</label><input type="datetime-local" name="end" class="form-control" required>
                            @error('end')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-4"><label>Registration Deadline</label><input type="datetime-local" name="registration_deadline" class="form-control">
                            @error('registration_deadline')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-6"><label>Can Cancel</label><select name="can_cancel" class="form-control"><option value="no">No</option><option value="yes">Yes</option></select>
                            @error('can_cancel')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-6"><label>Eligible Years</label><input name="eligible_years" class="form-control">
                            @error('eligible_years')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-6"><label>Event Code</label><input name="code" class="form-control">
                            @error('code')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                        <div class="col-md-6"><label>Media</label><input  id="mediaInput" type="file" name="media" class="form-control">
                            @error('media')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                            <small class="text-muted">Media is Required</small>
                        </div>
                        <div class="col-md-6" id="thumbnailField" style="display:none;">
                            <label>Thumbnail (for video)</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @error('thumbnail')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-12"><label>Caption</label><input name="caption" class="form-control">
                            @error('caption')
                                <small style="color:red;">{{ $message }}</small>
                            @enderror</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn-primary-custom" type="submit">Create</button>
                </div>
            </form>
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



        document.getElementById('mediaInput').addEventListener('change', function(e) {
        let file = e.target.files[0];
        if (file) {
            let ext = file.name.split('.').pop().toLowerCase();
            if (ext === 'mp4') {
                document.getElementById('thumbnailField').style.display = 'block';
            } else {
                document.getElementById('thumbnailField').style.display = 'none';
            }
        }
    });
        
        
        
        document.addEventListener('DOMContentLoaded', function () {
            const successAlert = document.getElementById('success-alert');

            if (successAlert) {
                setTimeout(function () {
                    successAlert.style.display = 'none';
                }, 3000);
            }
        });


        function confirmCancel(id) {
            if (confirm('Are you sure you want to cancel this event?')) {
                window.location.href = '/organizer/events/' + id + '/cancel';
            }
        }
        document.addEventListener("DOMContentLoaded", () => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 3000);
            });
        });
    </script>
</body>

</html>