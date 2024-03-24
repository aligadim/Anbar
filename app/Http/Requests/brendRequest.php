<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class brendRequest extends FormRequest
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
            'ad'=>'required|max:14|min:3',
            
        ];
    }

    public function messages()
    {
        return [
            'ad.required'=>'Ad daxil etməmdiniz',
            'ad.max'=>'Ad maksimum 14 simvol olmalıdır',
            'ad.min'=>'Ad minimum 3 simvol olmalıdır',

        ];
    
        
    }
}
