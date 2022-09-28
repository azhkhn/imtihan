<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'ignore_date',
        'company_id'
    ];
}
