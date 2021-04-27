<?php

namespace App\Http\Requests\Back\Assign;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAssignRequest extends FormRequest
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
            'brand' => 'required',
            'categories' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'brand.required' => 'Brand have not been selected.',
                'categories.required' => 'Sub category have not been selected.',
            ];
        } {
            return [
                'brand.required' => 'ကုန်အမှတ်တံဆိပ် အား ရွေးချယ်ရန်လိုအပ်ပါသည်။',
                'categories.required' => 'ကုန်ပစ္စည်း အမျိုးအစားခွဲ အား ရွေးချယ်ရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
