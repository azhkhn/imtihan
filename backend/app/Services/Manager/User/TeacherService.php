<?php

namespace App\Services\Manager\User;

use App\Models\User;
use App\Services\Base\BaseService;

class TeacherService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
