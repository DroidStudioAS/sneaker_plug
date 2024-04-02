<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "Name"=>"required|string",
            "available_amount"=>"required|int|gte:0",
            "category_id"=>"required|int|gte:0",
            "description"=>"required|string",
            "price"=>"required|int|gte:0",
            "image_name"=>"required|string"
        ];
    }
}
