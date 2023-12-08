<?php

namespace App\Http\Controllers;

use App\Services\Api\BaseServices;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    use HttpResponses;

    protected $defaultResource;
    protected BaseServices $defaultService;
    public $validated = [];
    public $load = [];

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            data: $this->defaultResource::collection($this->defaultService->index())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validated);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $created = new $this->defaultResource($this->defaultService->store($validator->validated()));

        if ($created) {
            return $this->response('Dados inseridos com sucesso', 200, $created);
        }

        return $this->errors('Something wrong', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->defaultService->show($id);

        return response()->json(
            data: new $this->defaultResource($result)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), $this->validated);

        if ($validator->fails()) {
            return $this->errors('Data Invalid', 422, $validator->errors());
        }

        $updated = new $this->defaultResource($this->defaultService->update($validator->validated(), $id));

        if ($updated) {
            return $this->response('Dados Atualizados com sucesso', 200, $updated);
        }

        return $this->errors('Something wrong', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->defaultService->destroy($id)) {
            return $this->errors("Não foi possível deletar o registro {$id}", 422);
        }

        return $this->response("Registro {$id} excluido com sucesso", 200);
    }
}
