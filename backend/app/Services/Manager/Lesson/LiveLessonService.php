<?php

namespace App\Services\Manager\Lesson;

use App\Models\LiveLesson;
use App\Services\Base\BaseService;

class LiveLessonService extends BaseService
{
    public function __construct()
    {
        parent::__construct(LiveLesson::class);
    }
}
