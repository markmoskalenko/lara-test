<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
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

    /**
     * @param ProductIndexRequest $request
     * @return array
     */
    public function index(ProductIndexRequest $request)
    {
        return $this->service->index($request);
    }

    /**
     * @param ProductCreateRequest $request
     * @return ProductResource
     */
    public function create(ProductCreateRequest $request)
    {
        return $this->service->create($request);

    }

    /**
     * @param $id
     * @param ProductUpdateRequest $request
     * @return ProductResource
     */
    public function update($id, ProductUpdateRequest $request)
    {
        return $this->service->update($id, $request);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id)
    {
        return $this->service->delete($id);
    }
}
