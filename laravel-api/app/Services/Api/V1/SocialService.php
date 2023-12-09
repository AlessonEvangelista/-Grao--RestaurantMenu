<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseServices;

class SocialService extends BaseServices
{
    public function __construct()
    {
        $this->searchableColumns = [
            'social',
            'url',
        ];
    }
}
