<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionByCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'company_id',
    ];

    /**
     * Get the question that owns the QuestionByCompany
     *
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

}
