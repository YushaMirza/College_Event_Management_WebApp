<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizerNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id', 'title', 'message', 'type', 'department', 'color'
    ];

    public function organizer() {
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
