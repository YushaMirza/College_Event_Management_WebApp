<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
    'title',
    'description',
    'category',
    'venue',
    'media_type',
    'media_file',
    'thumbnail',
    'caption',
    'organizer_id',
    'is_open',
    'status',
    'approved_by',
    'approved_at',
    'start',
    'end',
    'registration_deadline',
    'slots_fulled',
    'max_slots',
    'eligible_years',
    'code',
    'can_cancel',
];


    // Cast date/time columns to Carbon
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'registration_deadline' => 'datetime',
        'is_open' => 'boolean',
    ];

    // Organizer relationship (assuming users table)
    
    // public function organizer()
    // {
    //     return $this->belongsTo(User::class, 'organizer_id', 'enrollment_id');
    // }

    // Event registrations relationship
        public function registrations() {
        return $this->hasMany(EventRegistration::class, 'event_id');
    }

    // Helper: Available slots
    public function availableSlots()
    {
        return $this->max_slots - $this->slots_fulled;
    }

    // Helper: Check if registration is open
    public function registrationOpen()
    {
        return $this->is_open && ($this->registration_deadline ? now()->lte($this->registration_deadline) : true)
               && $this->availableSlots() > 0;
    }

    // Optional: Check if user is eligible by year
    public function isUserEligible($user)
    {
        if (!$this->eligible_years) return true;
        $allowedYears = explode(',', $this->eligible_years);
        return in_array($user->year, $allowedYears);
    }

    public function feedbacks() {
    return $this->hasMany(Feedback::class, 'event_id');
}

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id', 'enrollment_id');
    }
}
