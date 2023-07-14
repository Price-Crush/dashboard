<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExecutiveManagementRequest extends FormRequest
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
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|email|unique:users,email,'.request()->id,
            'password' => 'nullable|min:8',
            'is_active' => 'required|numeric',
            'phone' => 'required|numeric|digits_between:9,12|unique:users,phone,'.request()->id,
            'profile_pic' => 'nullable|mimes:jpg,bmp,png|max:2048',
            'promotion_level_id' => 'required|exists:admin_promotion_levels,id',
        ];
    }
}
