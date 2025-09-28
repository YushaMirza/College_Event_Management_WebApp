<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participation History</title>
    @include('student.layouts.links')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        .table-container {            
            padding: 120px 20px;
        }

        .section-title {
            font-size: 30px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .history-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        table {
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table thead tr th {
            border-bottom: none;
            color: #34495e;
            font-weight: 600;
        }

        .table tbody tr {
            background-color: #fdfdfd;
            border-radius: 12px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #eef2f7;
            transform: translateY(-2px);
        }

        .table td, .table th {
            vertical-align: middle;
            border: none;
        }

        .event-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            text-align: center;
        }

        .status-confirmed {
            background-color: #28a745;
        }

        .status-pending {
            background-color: #fd7e14;
        }

        .btn-download {
            background-color: #0056b3;
            color: #fff;
            padding: 7px 18px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-download i {
            margin-right: 6px;
            font-size: 1.1rem;
        }

        .btn-download:hover {
            background-color: #003d80;
            transform: translateY(-2px);
        }

        .text-muted {
            font-size: 0.9rem;
            color: #6c757d !important;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 24px;
            }
            .btn-download {
                font-size: 0.85rem;
                padding: 6px 12px;
            }
        }
    </style>
  	@include('student.layouts.header_css')
  
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
<div class="table-container">
<div class="container">
    <h2 class="section-title">Participation History</h2>
    <div class="history-card">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>SNo</th>
                        <th>Event Title</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th>Certificate</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse($myEventRegistrations as $registration)
                        @php $event = $registration->event; @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($registration->start)->format('M d, Y • h:i A') }}</td>
                            <td>{{ $event->venue }}</td>
                            <td>
                                @if($registration->attended === 'yes')
                                    <span class="event-status status-confirmed">Completed</span>
                                @else
                                    <span class="event-status status-pending">Pending</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $eventEndPassed = \Carbon\Carbon::parse($registration->event->end)->isPast();
                                @endphp
                                @if($registration->attended == 'yes' && $eventEndPassed)
                                    <a href="{{ route('certificate.download', $registration->id) }}" class="btn-download">
                                        <i class="bi bi-download"></i> Download
                                    </a>
                                @else
                                    <span class="text-muted">Attend event to get certificate</span>
                                @endif
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No events found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@include('student.layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>

</body>
</html>
