<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const KEY = 'key';
    const IS_ACTIVE = 'is_active';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::NAME => 'required|max:30',
            self::KEY => 'required|unique:categories',
        ];
    }
}
