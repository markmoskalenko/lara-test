<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:100'
        ];
    }
}
