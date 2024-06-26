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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',

        ];
    }


    public function messages(){
        return[
            'name.required'=>'Ad daxil etmədiniz',
            'email.required'=>'Email daxil etmədiniz',
            'password.required'=>'Parol daxil etmədiniz',

        ];
    }
}
