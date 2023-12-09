<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\ContactResources;
use App\Models\Contacts;
use App\Services\Api\V1\ContactsService;
use App\Traits\HttpResponses;

class ContactsController extends BaseController
{
    use HttpResponses;

    public $validated;

    public function __construct()
    {
        $this->validator();
        $this->defaultResource = ContactResources::class;
        $this->defaultService = (new ContactsService())
            ->setModel(Contacts::class);
        $this->permissionAuthenticated();
    }

    public function validator()
    {
        $this->validated = [
            'contact' => 'required',
            'type' => 'required',
            'main' => 'nullable|between:0,1',
            'restaurant_id' => 'required|numeric',
        ];
    }
}
