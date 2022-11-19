<?php

namespace App\Services\Admin\ClassRoom;

use App\Models\ClassRoom;
use App\Services\Base\BaseService;

class ClassRoomService extends BaseService
{
    public function __construct()
    {
        parent::__construct(ClassRoom::class);
    }
}
