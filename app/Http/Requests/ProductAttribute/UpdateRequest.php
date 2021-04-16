<?php

namespace App\Http\Requests\ProductAttribute;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'color' => 'required',
            'size' => 'required',
            'sku' => 'required',
            'buy_price' => 'required',
            'extra_cost' => 'required',
            'sale_price' => 'required',
            'photo.*' => 'image',
            'arrived' => 'required',
            'description_en' => 'required',
            'description_mm' => 'required',
        ];
    }

    public function messages()
    {
        if (session('locale') == 'en') {
            return [
                'color.required' => 'Color has Not been selected',
                'size.required' => 'Size has Not been selected',
                'sku.required' => 'Quantity is required',
                'buy_price.required' => 'Buying price is required',
                'extra_cost.required' => 'Extea cost is required',
                'sale_price.required' => 'Salling price is required',
                // 'photo.*.required' => 'Photo is required',
                'photo.*.image' => 'Photo must be a file of type: jpg, jpeg, png, svg.',
                'arrived.required' => 'Arrived is required',
                'description_en.required' => 'Description (en) is required.',
                'description_mm.required' => 'Description (mm) is required.',
            ];
        } {
            return [
                'color.required' => 'အရောင် အား ရွေးချယ်ရန်လိုအပ်ပါသည်။',
                'size.required' => 'အရွယ်အစား အား ရွေးချယ်ရန်လိုအပ်ပါသည်။',
                'sku.required' => 'အရေအတွက် အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'buy_price.required' => 'ဝယ်စျေး အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'extra_cost.required' => 'အပိုကုန်ကျငွေ အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'sale_price.required' => 'ရောင်းစျေး အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                // 'photo.*.required' => 'ပုံ အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'photo.*.image' => 'ကုန်အချက်အလက်ပုံ မှာ (jpg, jpeg, png, svg) ဖြစ်ရန်လိုအပ်ပါသည်။',
                'arrived.required' => 'ရောက်ရှိချိန် အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'description_en.required' => 'အချက်အလက် ၏ အကြောင်းအရာ (အင်္ဂလိပ်) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
                'description_mm.required' => 'အချက်အလက် ၏ အကြောင်းအရာ (မြန်မာ) အား ဖြည့်ရန်လိုအပ်ပါသည်။',
            ];
        }
    }
}
