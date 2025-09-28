<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EventSphare - Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" href="{{ asset('css/viewUsers.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboardStyle.css') }}">
  <link rel="stylesheet" href="{{ asset('css/addeventform.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
<link rel="stylesheet" href="{{asset('css/viewevent.css')}}">
<style>@media(max-width:850px){
.anouncement{
    display: none;
}
}</style>
  	<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  	@include('student.layouts.header_css')
  
    @include('student.layouts.footer_css')

</head>

<body style="position: relative;">
  @include('admin.compunents.hader')

  <main style="margin-top: 5px;min-height:85vh;padding-top:80px;min-height: calc(100vh - 97px);">
    @yield('main')
  </main>
  @include('admin.compunents.footer')
</body>
<script src="{{ asset('css/viewusers.js') }}"></script>
<script src="{{ asset('css/sidebar.js') }}"></script>
<script src="{{ asset('css/feedback.js') }}"></script>
<script src="{{ asset('css/notification.js') }}"></script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>