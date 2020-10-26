<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'price' => 'required|numeric',
            'is_published' => 'required|boolean',
            'category_id' => 'required|array|min:2|max:10',
            'category_id.*' => 'required|integer|exists:categories,id',
        ];
    }
}
