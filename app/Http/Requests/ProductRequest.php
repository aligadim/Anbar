<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'ad'=>'required|min:3',
            'alis'=>'required',
            'satis'=>'required',
            'miqdar'=>'required',
            'brand_id'=>'required',
        ];
    }

    public function messages(){

        return [
        'ad.required'=>'Ad daxil etmədiniz',
        'ad.min'=>'Ad minimum 3 simvol olmalıdır',
        'alis.required'=>'Alış daxil etmədiniz',
        'satis.required'=>'Satış daxil etmədiz',
        'miqdar.required'=>'Miqdar daxil etmədiniz',
        'brand_id.required'=>'Brend daxil etmədiniz',
        ];

    }
}
