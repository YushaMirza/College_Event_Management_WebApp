<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 50px;
        }

        .certificate-container {
            border: 10px solid #20497D;
            padding: 50px;
            position: relative;
            width: 90%;
            margin: auto;
        }

        h1 {
            font-size: 50px;
            color: #20497D;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 30px;
            color: #0386D4;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin: 5px 0;
        }

        .highlight {
            font-weight: bold;
            color: #001F48;
        }

        .footer {
            position: absolute;
            bottom: 30px;
            width: 90%;
            text-align: center;
            font-size: 16px;
            color: #20497D;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <h1>Certificate of Participation</h1>
        <h2>{{ $event->title }}</h2>
        <p>This is to certify that</p>
        <p class="highlight">{{ $user->name }}</p>
        <p>has successfully participated in the event</p>
        <p class="highlight">{{ $event->title }} (Event ID: {{ $event->id }})</p>
        <p>held at {{ $event->venue }} on {{ \Carbon\Carbon::parse($event->start)->format('F d, Y') }}.</p>
        <p>Date of Issue: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>

        <div class="footer">
            EventSphere - Official Certificate
        </div>
    </div>
</body>
</html>
