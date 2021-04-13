<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
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
            'subcategories' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'subcategories.required' => 'Sub category is not been selected.',
            ];
        } {
            return [
                'subcategories.required' => 'ကုန်ပစ္စည်း အမျိုးအစားခွဲ အား ရွေးချယ်ရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
