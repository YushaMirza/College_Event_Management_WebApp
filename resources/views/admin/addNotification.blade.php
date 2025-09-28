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

    <section class="manage-usrrs" style="padding: 50px 0">
        <div class="container">
            <div class="page-header justify-between d-flex flex-row">
                <div>

                    <h2 class="page-title">Add Notifications</h2>
                    <div class="date-display">{{ now()->format('l, F j, Y') }}</div>
                </div>
                <div>
                    <button class="btn btn-outline-light anouncement"
                        onclick="location.href='{{url('/admin/notificationForm')}}'"><i class="fas fa-bullhorn me-1"></i>
                        Send Announcement</button>
                </div>
            </div>
            <div class="add-notification-form">
                <form method="post" action="{{route('notification.store')}}">
                    @csrf

                    <div class="form-group">
                        <label for="title">Notification Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="message">Notification Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="reminder">Reminders</option>
                            <option value="guideline">Guidelines</option>
                            <option value="policy">Policy Updates</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="target_role">Target Department</label>
                        <select class="form-control" name="department">
                            <option value="">No Choose</option>
                            <option value="participant">Participant</option>
                            <option value="organizer">Organizer</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Send Notification</button>
                </form>
            </div>
    </section>
@endsection
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>

    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });


    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('#success-alert, #error-alert');

        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('fade');
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 3000);
        });
    });

    window.addEventListener('DOMContentLoaded', (event) => {
        const msg = document.getElementById('msg');
        if (msg) {
            setTimeout(() => {
                msg.style.display = 'none';
            }, 3000);
        }
    });
</script>