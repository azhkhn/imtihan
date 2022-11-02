<?php

namespace App\Services\Admin\Company;

use App\Models\User;
use App\Services\Base\BaseService;

class CompanyUserService extends BaseService
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
