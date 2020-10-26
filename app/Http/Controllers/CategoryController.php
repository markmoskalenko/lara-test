<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryIndexRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Routing\Controller as BaseController;

class CategoryController extends BaseController
{
    /**
     * @var CategoryService
     */
    public $service;

    /**
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(CategoryIndexRequest $request)
    {
        return $this->service->index($request);
    }

    public function create(CategoryCreateRequest $request)
    {
        return $this->service->create($request);

    }

    public function update(CategoryUpdateRequest $request)
    {
        return $this->service->update($request);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }
}
