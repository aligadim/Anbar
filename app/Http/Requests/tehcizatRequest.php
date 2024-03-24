<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class tehcizatRequest extends FormRequest
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
            'ad'=>'required|max:14|min:2',
            'soyad'=>'required|max:14|min:2',
            'tel'=>'required',
            'email'=>'required|email',
            'shirket'=>'required',
        ];
    }

    public function messages(){
        return [
            'ad.required'=>'Ad daxil etmədiniz',
            'ad.min'=>'Ad minimum 3 simvoldan ibarət olmalıdır',
            'ad.max'=>'Ad maxsimum 14 simvoldan ibarət olmalıdır',
            'soyad.required'=>'Soyad daxil etmədiniz',
            'soyad.min'=>'Soyad minimum 3 simvoldan ibaret olmalıdır',
            'soyad.max'=>'Soyad maxsimum 14 simvoldan ibarət olmalıdır',
            'tel.required'=>'Telefon daxil etmədiniz',
            'email.required'=>'Email daxil etmədiniz',
            'email.email'=>'Yanlış email formatı',
            'shirket.required'=>'Şirkət daxil etmədiniz',
            
            

        ];
    }


}
