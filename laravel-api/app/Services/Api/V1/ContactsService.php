<?php

namespace App\Services\Api\V1;

use App\Services\Api\BaseServices;

class ContactsService extends BaseServices
{
    public function __construct()
    {
        $this->searchableColumns = [
            'contact',
            'type',
        ];
    }
}
