<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientRequest extends FormRequest
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
            'ad' => 'required|max:14|min:3',
            'soyad'=>'required|max:14|min:4',
            'tel'=> 'required|max:14|min:4',
            'email'=>'required|email',
            'sirket'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'ad.required' =>'Ad daxil etmədiniz',
            'ad.max'=>'Ad maksimun 14 simvol olmalıdır',
            'ad.min'=>'Ad minimum 3 simvol olmalıdır',
            'soyad.required' =>'Soyad daxil etmədiniz',
            'soyad.max'=>'Soyad maksimun 14 simvol olmalıdır',
            'soyad.min'=>'Soyad minimum 3 simvol olmalıdır',
            'tel.required' =>'Telefon daxil etmədiniz',
            'tel.max'=>'Telefon maksimun 14 simvol olmalıdır',
            'tel.min'=>'Telefon minimum 3 simvol olmalıdır',
            'email.required' =>'Email daxil etmediniz',
            'email.email'=>'Yanlış email formatı',
            'sirket.required'=>'Şirkət daxil etmədiniz',

        ];
    }
}
