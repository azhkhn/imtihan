<?php

namespace App\Services\Admin;

use App\Models\Company;
use App\Services\Base\BaseService;

class CompanyService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Company::class);
    }
}
