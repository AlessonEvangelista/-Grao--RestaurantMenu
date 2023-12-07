<?php

namespace App\Services\Api\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServicesInterface
{
    public function index(): LengthAwarePaginator|Collection;

    // public function show(int $id): Model;

    // public function store(): Model;

    // public function update(int $id): Model;

    // public function destroy(int $id): bool;
}
