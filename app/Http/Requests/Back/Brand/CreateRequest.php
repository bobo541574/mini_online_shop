<?php

namespace App\Http\Requests\Back\Brand;

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
            'name_en' => 'required',
            'name_mm' => 'required',
            'photo' => 'required|image',
            'description_en' => 'required',
            'description_mm' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'name_en.required' => 'Name (en) is required.',
                'name_mm.required' => 'Name (mm) is required.',
                'photo.required' => 'Photo is required.',
                'photo.image' => 'Photo must be a file of type: jpg, jpeg, png, svg.',
                'description_en.required' => 'Description (en) is required.',
                'description_mm.required' => 'Description (mm) is required.',
            ];
        } {
            return [
                'name_en.required' => 'ကုန်အမှတ်တံဆိပ် အမည် (အင်္ဂလိပ်) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'name_mm.required' => 'ကုန်အမှတ်တံဆိပ် အမည် (မြန်မာ) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'photo.required' => 'ကုန်အမှတ်တံဆိပ်ပုံ အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'photo.image' => 'ကုန်အမှတ်တံဆိပ်ပုံ မှာ (jpg, jpeg, png, svg) ဖြစ်ရန်လိုအပ်ပါသည်။',
                'description_en.required' => 'ကုန်အမှတ်တံဆိပ် အချက်အလက် (အင်္ဂလိပ်) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'description_mm.required' => 'ကုန်အမှတ်တံဆိပ် အချက်အလက် (မြန်မာ) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
