<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class komendantRequest extends FormRequest
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
            'tapsiriq'=>'required',
            'tarix'=>'required',
            'vaxt'=>'required',
        ];
    }

    public function messages(){
        return [
            'tapsiriq.required'=>'Tapşırıq daxil etmədiniz',
            'tarix.required'=>'Tarix daxil etmədiniz',
            'vaxt.required'=>'Saat daxil etmədiniz'
        ];
    }
}
