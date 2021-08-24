<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidation extends FormRequest
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
            'image'=>'required|mimes:jpg,png,jpeg|max:5048',
            'name'=>'required|unique:cars',
            // 'name' => new Uppercase,
            'founded' =>'required|integer|min:0|max:2021',
            'description'=>'required'
        ];
    }
}
