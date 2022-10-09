<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    /**
     * @var string[]
     */
    protected $fillable = [
        'description',
        'date',
        'is_active',
        'teacher_id',
        'user_id',
        'company_id',
    ];
}
