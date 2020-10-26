<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    public $service;

    /**
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index(ProductIndexRequest $request)
    {
        return $this->service->index($request);
    }

    public function create(ProductCreateRequest $request)
    {
        return $this->service->create($request);

    }

    public function update(ProductUpdateRequest $request)
    {
        return $this->service->update($request);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }
}
