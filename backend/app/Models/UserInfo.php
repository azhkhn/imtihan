<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'phone',
        'address',
        'status',
        'start_date',
        'end_date',
        'class_id',
        'language_id',
        'company_id',
        'user_id',
    ];

    //TODO: getter setter eklenecek
}
