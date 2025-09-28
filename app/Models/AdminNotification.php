<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminNotification extends Model
{
    use HasFactory;
     protected $fillable = [
         'admin_id',
        'title',
        'message',
        'type',
        'department',
        'color',
    ];

    public function admin()
    {
        return $this->belongsTo(\App\Models\Admin::class);
    }
}
