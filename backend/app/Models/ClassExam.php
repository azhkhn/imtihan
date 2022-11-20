<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassExam extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'company_id',
        'class_id',
        'is_active',
    ];

    /**
     * @return HasMany
     */
    public function classExamCategories(): HasMany
    {
        return $this->hasMany(ClassExamCategory::class);
    }
}
