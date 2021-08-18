<?php

namespace App\Http\Requests\Back\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'name_en' => 'required',
            'name_mm' => 'required',
            'supplier' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'brand' => 'required',
        ];
    }

    /**
     * Set the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages():array
    {
        return [
            'name_en.required' => 'product_name_en_required',
            'name_mm.required' => 'product_name_mm_required',
            'supplier.required' => 'supplier_required',
            'category.required' => 'category_required',
            'subcategory.required' => 'subcategory_required',
            'brand.required' => 'brand_required',
        ];
    }
}
