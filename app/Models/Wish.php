<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_name',
        'attendance_status',
        'guest_count',
        'message',
        'receipt_image',
    ];
}
