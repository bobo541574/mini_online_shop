<?php

namespace App\Http\Requests\Front\Order;

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
            'sku' => 'required',
            'contact_id' => 'required',
            'attribute_id' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'sku.required' => 'Product quantity is required.',
                'contact_id.required' => 'Delivery address is required',
                'attribute_id.required' => 'Color and Size is required',
            ];
        } else {
            return [
                'sku.required' => 'ကုန်ပစ္စည်း အရေအတွက် ထည့်ရန်လိုအပ်သည်။',
                'contact_id.required' => 'ပေးပို့ရန် လိပ်စာ ထည့်ရန်လိုအပ်သည်။',
                'attribute_id.required' => 'ကာလာ နှင့် အရွယ်အစား ထည့်ရန်လိုအပ်သည်။',
            ];
        }
    }
}
