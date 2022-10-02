<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamResultCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total_questions',
        'correct',
        'in_correct',
        'blank',
        'category_id',
        'exam_id',
        'user_id',
    ];
}
