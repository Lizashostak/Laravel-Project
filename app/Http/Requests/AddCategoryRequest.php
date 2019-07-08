<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest {

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
            'cat_name' => 'required|unique:categories,name',
            'cat_url' => 'required|unique:categories,cat_url',
            'description' => 'required|min:10|max:500',
            'image' => 'image',
        ];
    }

    public function messages() {
        return [
            'cat_name.unique' => 'Category with this Name already exists',
            'cat_url.unique' => 'Category with this URL already exists',
        ];
    }

}
