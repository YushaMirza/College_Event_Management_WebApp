<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    
    protected $fillable = [
        'message',
        'category',
        'audience',
    ];
}
