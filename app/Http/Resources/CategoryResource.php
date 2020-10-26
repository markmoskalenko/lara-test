<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Category $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}