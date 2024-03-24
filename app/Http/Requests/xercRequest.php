<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class xercRequest extends FormRequest
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
            'teyinat'=>'required|min:3',
            'mebleg'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'teyinat.required'=>'Təyinat daxil etmədiniz',
            'teyinat.min'=>'Təyinat minimum 3 simvol olmalıdır',
            'mebleg.required'=>'Məbləğ daxil etmədiniz',

        ];
    }
}
