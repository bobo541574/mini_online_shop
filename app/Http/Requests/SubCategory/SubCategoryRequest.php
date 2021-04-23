<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'parent_id' => 'required',
            'name_en' => 'required',
            'name_mm' => 'required',
            'description_en' => 'required',
            'description_mm' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'parent_id.required' => 'Category is not selected.',
                'name_en.required' => 'Name (en) is required.',
                'name_mm.required' => 'Name (mm) is required.',
                'description_en.required' => 'Description (en) is required.',
                'description_mm.required' => 'Description (mm) is required.',
            ];
        } {
            return [
                'parent_id.required' => 'အမျိုးအစား အား ရွေးချယ်ပေးရန်လိုအပ်ပါသည်။',
                'name_en.required' => 'အမျိုးအစား အမည် (အင်္ဂလိပ်) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'name_mm.required' => 'အမျိုးအစား အမည် (မြန်မာ) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'description_en.required' => 'အမျိုးအစား အချက်အလက် (အင်္ဂလိပ်) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'description_mm.required' => 'အမျိုးအစား အချက်အလက် (မြန်မာ) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
