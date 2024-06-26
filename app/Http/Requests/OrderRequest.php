<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            "contact_email"=>"required|email",
            "contact_number"=>"required|numeric",
            "payment_method"=>"required|string",
            "delivery_address"=>"required|string",
            "delivery_city_country"=>"required|string",
            "postal_code"=>"required|string"
        ];
    }
}
