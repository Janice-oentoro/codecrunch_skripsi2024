<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'bank_acc',
        'amount',
        'type',
        'status'
    ];
}
