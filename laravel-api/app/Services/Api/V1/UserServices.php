<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseServices;

class UserServices extends BaseServices
{
    public function __construct()
    {
        $this->searchableColumns = [
            'name',
            'email',
        ];
    }
}
