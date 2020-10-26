<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Product $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'category' => CategoryResource::collection($this->categories)
        ];
    }
}