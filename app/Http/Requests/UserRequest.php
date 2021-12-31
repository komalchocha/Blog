<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id=$this->id;
        return [
            'email'=> 'required|unique:users,email,' .$id,
            'name'=> 'required',
            'mobile_number'=>'required|unique:users,mobile_number,' .$id,
            

        ];
    }

    public function attributes()
    {
        return [
            'mobile_number' => 'mobile'
        ]
    }
}
