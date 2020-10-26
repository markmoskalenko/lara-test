<?php

namespace App\Services;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductService
{
    /**
     * @param ProductIndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ProductIndexRequest $request)
    {
        $product = Product::query();
        if ($request->has('name')) {
            $product->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('is_published')) {
            $product->where('is_published', $request->input('is_published'));
        }

        if ($request->has('category_id')) {
            $product->whereHas('category', function ($query) use ($request)
            {
                return $query->whereIn('category_id', (array)$request->get('category_id'));
            });
        }

        if ($request->has('price_from')) {
            $product->where('price', '>=', $request->get('price_from'));
        }

        if ($request->has('price_to')) {
            $product->where('price', '<=', $request->get('price_to'));
        }

        if ($request->get('is_delete') === true) {
            $product->onlyTrashed();
        }

        return ProductResource::collection($product->get());
    }

    /**
     * @param ProductCreateRequest $request
     * @return ProductResource
     */
    public function create(ProductCreateRequest $request)
    {
        $product = Product::create($request->all());

        $categoryIds = array_unique((array)$request->input('category_id'));

        foreach ($categoryIds as $categoryId) {
            $category = new ProductCategory();
            $category->product_id = $product->id;
            $category->category_id = (int)$categoryId;
            $category->save();
        }

        return new ProductResource($product);
    }

    /**
     * @param $id
     * @param ProductUpdateRequest $request
     * @return ProductResource
     */
    public function update($id, ProductUpdateRequest $request)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());

        // Тут можно сделать проверку на существующие и удлять только те которых нету в массиве.
        ProductCategory::where('product_id', $product->id)->delete();

        $categoryIds = array_unique((array)$request->input('category_id'));
        foreach ($categoryIds as $categoryId) {
            $category = new ProductCategory();
            $category->product_id = $product->id;
            $category->category_id = (int)$categoryId;
            $category->save();
        }

        return new ProductResource($product);
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function delete(int $id)
    {
        /** @var Product $product */
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
