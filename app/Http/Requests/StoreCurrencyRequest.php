<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            "name" => "required|string|max:255",
            "code" => "required|string|max:255",
            "symbol" => "required|string|max:255",
            "format" => "required|string|max:255",
            "exchange_rate" => "required|numeric",
            "active" => "required|numeric"
        ];
    }
}
