<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassExam extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'month_id',
        'class_id',
        'status'
    ];
}
