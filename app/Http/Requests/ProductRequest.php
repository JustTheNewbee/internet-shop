<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const PRICE = 'price';
    const QUANTITY = 'quantity';
    const CATEGORY_ID = 'category_id';
    const IS_ACTIVE = 'is_active';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::NAME => 'required|max:50',
            self::PRICE => 'required|min:0',
            self::QUANTITY => 'required|min:0',
        ];
    }
}
