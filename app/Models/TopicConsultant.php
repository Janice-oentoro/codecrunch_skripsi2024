<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicConsultant extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic_id',
        'consultant_id'
    ];
}
