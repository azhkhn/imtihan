<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassExamCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'class_exam_id',
        'category_id',
        'length',
    ];
}
