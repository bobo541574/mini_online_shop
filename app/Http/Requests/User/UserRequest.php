<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'first_name.required' => 'First name is required.',
                'last_name.required' => 'Last name is required.',
                'user_name.required' => 'User name is required.',
                'email.required' => 'Email is required.',
                'phone.required' => 'Phone name is required.',
                'password.required' => 'Password name is required.',
                'password.confirmed' => 'Password is not matched.',
            ];
        } {
            return [
                'first_name.required' => 'အသုံးပြုသူ၏ ရှေ့နာမည် အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'last_name.required' => 'အသုံးပြုသူ၏ နောက်နာမည် အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'user_name.required' => 'အသုံးပြုသူ၏ နာမည် အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'email.required' => 'အသုံးပြုသူ၏ အီးမေး အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'phone.required' => 'အသုံးပြုသူ၏ ဖုန်း အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'password.required' => 'အသုံးပြုသူ၏ စကားဝှက် အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'password.confirmed' => 'အသုံးပြုသူ၏ စကားဝှက် တူညီရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
