<?php

namespace App\Services\Admin\Question;

use App\Models\Question;
use App\Services\Base\BaseService;

class QuestionService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Question::class);
    }
}
