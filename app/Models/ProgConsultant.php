<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgConsultant extends Model
{
    use HasFactory;
    protected $fillable = [
        'prog_id',
        'consultant_id'
    ];
}
