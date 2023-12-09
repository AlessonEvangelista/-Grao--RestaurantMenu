<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\Api\V1\SocialResources;
use App\Models\Social;
use App\Services\Api\V1\SocialService;
use App\Traits\HttpResponses;
use Illuminate\Validation\Rule;

class SocialController extends BaseController
{
    use HttpResponses;

    public $validated;

    public function __construct()
    {
        $this->validator();
        $this->defaultResource = SocialResources::class;
        $this->defaultService = (new SocialService())
            ->setModel(Social::class);
    }

    public function validator()
    {
        $this->validated = [
            'social' => 'required', Rule::In(['Facebook' | 'Instagran' | 'X' | 'Linkedin' | 'Other']),
            'url' => 'required|url',
            'restaurant_id' => 'required|numeric',
        ];
    }
}
