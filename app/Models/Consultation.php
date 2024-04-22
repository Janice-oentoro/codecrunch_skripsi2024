<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consultant_id',
        'consult_datetime',
        'title',
        'desc',
        'type',
        'status',
        'link'
    ];
}
