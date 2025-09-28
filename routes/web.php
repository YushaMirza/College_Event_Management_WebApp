<?php

use App\Models\OrganizerNotification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\AdminEventsController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrganizerEventController;
use App\Http\Controllers\AddNotificationController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\OrganizerNotificationController;

Route::middleware('guest')->group(function () {
    Route::view('/signup', 'auth.signup')->name('showsignup');
    Route::view('/login', 'auth.login')->name('showlogin');

    Route::post('/signup/data', [UserController::class, 'register'])->name('signup');
    Route::post('/login/data', [UserController::class, 'login'])->name('login');

    Route::post('/otp/verify', [UserController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/otp/regen', [UserController::class, 'regenOtp'])->name('otp.regen');
});
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'showHome'])->name('home');

Route::get('/events', [EventController::class, 'showEvents'])->name('events');

Route::get('/gallery', [EventController::class, 'showGallery'])->name('gallery');


Route::get('/about', [EventController::class, 'showAbout'])->name('about');

Route::get('/contact-us', [EventController::class, 'showContact'])->name('contact_us');

Route::post('/contact-us', [ContactController::class, 'submitMessage'])->name('contact.store');

Route::get('/faqs', [EventController::class, 'showfaqs'])->name('faqs');

Route::middleware(['auth'])->group(function () {

    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/profile', [ProfileController::class, 'showprofile'])->name('profile');
    Route::post('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile_image.update');
    Route::post('/profile/update-details', [ProfileController::class, 'updateDetails'])->name('profile_detail.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile_password.update');

    Route::get('/participant', [DashboardController::class, 'index'])->name('participant_dashboard');
    Route::delete('/events/{registration}/cancel', [DashboardController::class, 'cancelRegistration'])->name('events.cancel');
    Route::get('/certificate/download/{registration}', [DashboardController::class, 'downloadCertificate'])->name('certificate.download');
    Route::post('/events/checkin/{id}', [EventController::class, 'checkIn'])->name('events.checkin');

    Route::get('/events/register', [EventController::class, 'eventRegister'])->name('participant_events.register');
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

    Route::get('/participant/history', [ParticipantController::class, 'participationHistory'])->name('participant_history');

    Route::post('/favourites', [FavouriteController::class, 'store'])->name('favourites.store');
    Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites.index');
    Route::delete('/favourites/{favourite}', [FavouriteController::class, 'destroy'])->name('favourites.destroy');
    Route::get('/participant/saved-media', [FavouriteController::class, 'savedMedia'])->name('participant.saved_media');


    Route::get('/event/detail/{id}', [EventController::class, 'showEventDetail'])->name('event_detail');

    Route::post('organizer/notifications/mark-all-read', [OrganizerNotificationController::class, 'markAllRead'])->name('organizer.notifications.markAllRead');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'CardsCalc'])->name('admin_dashboard');
    Route::patch('/admin/events/{id}/approve', [AdminDashboardController::class, 'approve'])->name('events.approve');
    Route::post('/admin/participants/{id}/approve', [AdminDashboardController::class, 'userapprove'])->name('participents.approve');
    Route::post('/admin/participants/{id}/reject', [AdminDashboardController::class, 'userreject'])->name('participent.reject');

    Route::get('/admin/notificationForm', [AdminNotificationController::class, 'getDepartment'])->name('notification.form');
    Route::post('/add-notification', [AdminNotificationController::class, 'storeNotifications'])->name('notification.store');
    Route::get('admin/media', [EventController::class, 'showMedia'])->name('adminmedia');
    Route::get('/admin/feedback', [FeedbackController::class, 'viewFeedback'])->name('adminfeedback');
    Route::delete('/feedback/{id}', [FeedbackController::class, 'deletefeedback'])->name('feedback.delete');
    Route::post('/feedback/approve/{id}', [FeedbackController::class, 'approve'])->name('feedback.approve');

    Route::get('/viewUsers', [AdminDashboardController::class, 'viewuserdata'])->name('view.users');
    Route::get('/deleteUsers/{id}', [AdminDashboardController::class, 'deleteUserData'])->name('delete.user');
    Route::get('/user', [AdminDashboardController::class, 'viewuserdata'])->name('user.list');
    Route::get('/search', [AdminDashboardController::class, 'viewuserdata'])->name('user.search');
    Route::get('/searchingEvents', [AdminEventsController::class, 'vieweventdata'])->name('event.search');
    Route::get('/searchEvents', [AdminEventsController::class, 'eventdata'])->name('eventdata.search');
    Route::get('/searchFeedback', [FeedbackController::class, 'searchFeedback'])->name('feeback.search');
    Route::get('/admin/users/{id}/edit', [AdminDashboardController::class, 'edit'])->name('user.edit');
    Route::get('/delete/{id}', [AdminDashboardController::class, 'deleteUserData'])->name('user.delete');
    Route::patch('/user/{id}/toggle-status', [AdminDashboardController::class, 'toggleStatus'])->name('user.toggleStatus');


    Route::get('/report/view/{id}', [ReportsController::class, 'getReport'])->name('report.view');
    Route::get('/report/download', [downloadReportController::class, 'downloadReport'])->name('report.download');


    Route::get('/admin/eventDec', [AdminEventsController::class, 'viewEventDescription'])->name('view.events');
    Route::get('/admin/media/delete/{id}', [AdminDashboardController::class, 'deletemedia']);
    Route::post('/events/{id}/approve', [AdminEventsController::class, 'approve'])->name('events.approve');
    Route::post('/events/{id}/reject', [AdminEventsController::class, 'reject'])->name('events.reject');
    Route::post('/events/{id}/generate-certificate', [EventController::class, 'generateCertificate'])
        ->name('events.generate_certificate');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/organizer/dashboard', [OrganizerEventController::class, 'index'])->name('organizer_dashbaord');
    Route::post('/organizer/events', [OrganizerEventController::class, 'store'])->name('organizer.events.store');
    // extra
    Route::get('/organizer/events/{id}/edit', [EventController::class, 'edit'])->name('organizer.events.edit');
// 
    Route::put('/organizer/events/{id}/update', [OrganizerEventController::class, 'update'])->name('organizer.events.update');
    Route::get('/organizer/events/{event}/cancel', [OrganizerEventController::class, 'cancel'])->name('organizer.events.cancel');
    Route::get('/events/registrations', [OrganizerEventController::class, 'registrations'])->name('organizer.events.registrations');

});
