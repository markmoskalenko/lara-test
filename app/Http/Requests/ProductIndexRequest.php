<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'category_id' => 'nullable|array',
            'category_id.*' => 'required|integer|exists:categories,id',
            'price_from' => 'nullable|numeric',
            'price_to' => 'nullable|numeric',
            'is_delete' => 'nullable|boolean'
        ];
    }
}
