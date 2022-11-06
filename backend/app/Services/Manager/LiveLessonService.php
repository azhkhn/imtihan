<?php

namespace App\Services\Manager;

use App\Models\LiveLesson;
use App\Services\Base\BaseService;

class LiveLessonService extends BaseService
{
    public function __construct()
    {
        parent::__construct(LiveLesson::class);
    }
}
