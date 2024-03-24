<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class vezifeRequest extends FormRequest
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
            
            'ad'=>'required',
        ];
    }

    public function messages()
    {
        return [
         
            'ad.required'=>'Vəzifə daxil etmədiniz',
            

        ];
    }
}


