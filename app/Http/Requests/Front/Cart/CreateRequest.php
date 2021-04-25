<?php

namespace App\Http\Requests\Front\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attribute_id' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'attribute_id.required' => "Product has not been selected.",
            ];
        } else {
            return [
                'attribute_id.required' => "ကုန်ပစ္စည်း ကို ရွေးချယ်မှု မပြုလုပ်ရသေးပါ။",
            ];
        }
    }
}
