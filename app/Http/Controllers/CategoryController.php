<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryIndexRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
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

    /**
     * @param CategoryIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(CategoryIndexRequest $request)
    {
        return $this->service->index($request);
    }

    /**
     * @param CategoryCreateRequest $request
     * @return CategoryResource
     */
    public function create(CategoryCreateRequest $request)
    {
        return $this->service->create($request);

    }

    /**
     * @param $id
     * @param CategoryUpdateRequest $request
     * @return CategoryResource
     */
    public function update($id, CategoryUpdateRequest $request)
    {
        return $this->service->update($id, $request);
    }

    /**
     * @param int $id
     * @return Application|ResponseFactory|Response|object|void
     * @throws Exception
     */
    public function delete(int $id)
    {
        $result = $this->service->delete($id);

        return $result === false
            ? response(['message' => 'Category used'])->setStatusCode('422')
            : abort(204);
    }
}
