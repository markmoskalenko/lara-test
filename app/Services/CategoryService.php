<?php

namespace App\Services;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryIndexRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService
{
    /**
     * @param CategoryIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(CategoryIndexRequest $request)
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * @param CategoryCreateRequest $request
     * @return CategoryResource
     */
    public function create(CategoryCreateRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    /**
     * @param $id
     * @param CategoryUpdateRequest $request
     * @return CategoryResource
     */
    public function update($id, CategoryUpdateRequest $request)
    {
        /** @var Category $category */
        $category = Category::findOrFail((int)$id);
        $category->fill($request->all());
        $category->save();

        return new CategoryResource($category);
    }

    /**
     * @param int $id
     * @return false
     * @throws Exception
     */
    public function delete(int $id)
    {
        /** @var Category $category */
        $category = Category::findOrFail((int)$id);
        $used = ProductCategory::where('category_id', $category->id)->exists();

        if ($used) {
            return false;
        }

        if (!$used) {
            $category->delete();
        }
    }
}
