<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name_ar" => 'required|max:255|string',
            "name_en" => 'required|max:255|string',
            "name_tr" => 'required|max:255|string',
            "notification_no" => 'required|numeric',
            "discount" => 'required|numeric',
            'icon' => 'required|mimes:jpg,bmp,png|max:2048',
        ];
    }
}
