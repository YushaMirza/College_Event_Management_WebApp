<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registrations Monitor</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F0F3FA;
            overflow-x: hidden;
        }

        h2 {
            font-weight: 700;
            color: #395886;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-3px);
        }

        .card-header {
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .badge {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.4em 0.75em;
            border-radius: 8px;
        }

        table th, table td {
            font-size: 0.9rem;
            vertical-align: middle;
        }

        table th {
            background-color: #D5DEEF;
            color: #395886;
            text-transform: uppercase;
        }

        .btn-primary-custom {
            background-color: #638ECB;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.6rem 1.2rem;
            border: none;
            transition: background 0.2s ease;
        }
        .btn-primary-custom:hover {
            background-color: #395886;
        }

        .collapse-card-body {
            background-color: #F9FAFC;
        }

    </style>
  	@include('student.layouts.header_css')
  
    @include('student.layouts.footer_css')
</head>
<body>
@include('student.layouts.header')
<div class="container py-5">
    <h2 class="mb-4">Event Registrations Monitor</h2>

    @foreach($events as $event)
    <div class="card mb-4 shadow-sm" data-aos="fade-up">
        <div class="card-header d-flex justify-content-between align-items-center" style="background:#8AAEE0; color:white;">
            <div>
                <strong>{{ $event->title }}</strong>
                <span class="badge bg-light text-dark">{{ $event->registrations_count }} Registrations</span>
            </div>
            <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#eventParticipants{{ $event->id }}">
                View Participants
            </button>
        </div>
        <div class="collapse" id="eventParticipants{{ $event->id }}">
            <div class="card-body collapse-card-body">
                @if($event->registrations_count > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Enrollment ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Registered At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($event->registrations as $index => $reg)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $reg->user->enrollment_id }}</td>
                                <td>{{ $reg->user->first_name }} {{ $reg->user->last_name }}</td>
                                <td>{{ $reg->user->email }}</td>
                                <td>{{ $reg->user->phone }}</td>
                                <td>{{ $reg->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-{{ $reg->attended=='yes'?'success':'secondary' }}">
                                        {{ ucfirst($reg->attended ?? 'Pending') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">No registrations yet.</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach

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
</script>

</body>
</html>
