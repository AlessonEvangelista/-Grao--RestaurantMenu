<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseServices;

class CategoryService extends BaseServices
{
    public function __construct()
    {
        $this->searchableColumns = [
            'name',
        ];
    }
}
