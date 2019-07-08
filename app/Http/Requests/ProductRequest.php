<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'description' => 'required|max:2500',
            'details' => 'required|max:2500',
            'image' => 'required|image',
            'name' => 'unique:products,name',
            'gender' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'description.max' => 'Description Is Too Long',
            'details.max' => 'Details Are Too Long',
            'name.unique' => 'Product with this name already exists',
            'price.numeric' => 'Insert only Numbers to the Product price, The Price is in EUR ',
        ];
    }

}
