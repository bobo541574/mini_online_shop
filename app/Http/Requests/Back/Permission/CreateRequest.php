<?php

namespace App\Http\Requests\Back\Permission;

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
            // 'type' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'name_en.required' => 'Name (en) is required.',
                'name_mm.required' => 'Name (mm) is required.',
                // 'type.required' => 'Type is required.',
            ];
        } {
            return [
                'name_en.required' => 'အသုံးပြုခွင့် အမည် (အင်္ဂလိပ်) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'name_mm.required' => 'အသုံးပြုခွင့် အမည် (မြန်မာ) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                // 'type.required' => 'အသုံးပြုခွင့် အမျိုးအစားအား ဖြည့်ရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
