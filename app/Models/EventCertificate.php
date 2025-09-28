<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCertificate extends Model
{
    use HasFactory;

    protected $table = 'event_certificates';

    // Mass assignable fields
    protected $fillable = [
        'event_id',
        'file_path',
        'issued_at',
    ];

    // Event relation
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    // User relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'issued_at' => 'datetime',
    ];
}
