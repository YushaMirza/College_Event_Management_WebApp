<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <title>Event Report</title>
    <style>
        :root {
            --lightest: #B4D9F2;
            --light: #6EB6E8;
            --medium-light: #0386D4;
            --medium: #0386D4;
            --medium-dark: #20497D;
            --dark: #001F48;
            --shadow: rgba(32, 73, 125, 0.2);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .report {
            margin: 20px;
        }

        .report p {
            font-size: 14px;
            margin: 8px 0;
        }

        h1,
        h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--dark);
        }

        .btn {
            display: inline-block;
            background: var(--medium-dark);
            color: white;
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 300;
            transition: var(--transition);
            border: 2px solid var(--medium-dark);
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            background: transparent;
            color: var(--medium-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px var(--shadow);
        }

        .btn-outline {
            background: transparent;
            color: var(--medium-dark);
            border: 2px solid var(--medium-dark);
        }

        .btn-outline:hover {
            background: var(--medium-dark);
            color: white;
        }
    </style>
</head>

<body>
    <div id="report">
        <div class="page-header justify-between d-flex flex-row">
            <div>
                <h2 class="page-title">View Reports</h2>
                <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
            </div>
            <div>
                <div class="report">
                    <h4><strong>Title:</strong> {{ $event->title }}</h4>
                    <p><strong>Total Slots:</strong> {{ $totalSlots }}</p>
                    <p><strong>Total Event Registrations:</strong> {{ $totalSlots }}</p>
                    <p><strong>Slots Filled:</strong> {{ $slotsFulled }}</p>
                    <p><strong>Participations:</strong> {{ $participations }}</p>
                    <p><strong>User Growth:</strong> {{ $userGrowth }}</p>
                    <p><strong>Average Rating:</strong> {{ $avgRating }}</p>
                    <div class="mt-4">
                        <button id="download" class="btn btn-primary">Download PDF</button>
                    </div>
                </div>
</body>
<script>
    document.getElementById("download").addEventListener("click", () => {
        const element = document.getElementById("report");
        html2pdf().from(element).save("report.pdf");
    });
</script>

</html>