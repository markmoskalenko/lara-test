<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'price' => 'required|numeric',
            'is_published' => 'required|boolean',
            'category_id' => 'required|array',
            'category_id.*' => 'required|integer|exists:categories,id',
        ];
    }
}
