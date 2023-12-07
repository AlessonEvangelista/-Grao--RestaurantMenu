<?php

namespace App\Http\Controllers;

use App\Services\Api\BaseServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $defaultResource;
    protected BaseServices $defaultService;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            data: $this->defaultResource::collection($this->defaultService->index())
        );
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    // }

    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(string $id)
    // {
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // function destroy(string $id)
    // {
    // }
}
