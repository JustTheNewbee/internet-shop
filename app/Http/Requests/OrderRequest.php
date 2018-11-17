<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    const PRODUCT_ID = 'product_id';
    const QUANTITY = 'quantity';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::PRODUCT_ID => 'required:integer|min:1',
            self::QUANTITY => 'required|integer|min:1',
        ];
    }
}
