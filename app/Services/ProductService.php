<?php

namespace App\Services;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductService
{
    public function index(ProductIndexRequest $request)
    {
        return [];
    }

    public function create(ProductCreateRequest $request)
    {
        return;
    }

    public function update(ProductUpdateRequest $request)
    {
        return;
    }

    public function delete(int $id)
    {
        return;
    }
}
