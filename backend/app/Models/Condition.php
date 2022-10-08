<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'question_category_id',
        'condition_category_id',
        'value',
        'is_active'
    ];
}
