<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionOption extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'description',
        'question_id',
        'is_correct',
        'src',
    ];
}
