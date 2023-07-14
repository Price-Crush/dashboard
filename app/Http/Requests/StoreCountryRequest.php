<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
            'country_code' => 'required|string|max:255',
            'country_enName' => 'required|string|max:255',
            'country_arName' => 'required|string|max:255',
            'country_trName' => 'required|string|max:255',
            'country_enNationality' => 'required|string|max:255',
            'country_arNationality' => 'required|string|max:255',
            'country_trNationality' => 'required|string|max:255',
            'price' => 'required',
            'google_ads' => 'required|numeric',
        ];
    }
}
