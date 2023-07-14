<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
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
            "country_id" => 'required|numeric|exists:countries,id',
            "name_ar" => 'required|string|max:255',
            "name_en" => 'required|string|max:255',
            "name_tr" => 'required|string|max:255',
            "price" => 'required|numeric',
        ];
    }
}
