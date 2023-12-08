<?php

namespace App\Services\Api\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServicesInterface
{
    public function index(): LengthAwarePaginator|Collection;

    public function show(int $id): Model|Builder;

    public function store(array $data): Model;

    public function update(array $data, int $id): Model|Builder;

    public function destroy(int $id): bool;
}
