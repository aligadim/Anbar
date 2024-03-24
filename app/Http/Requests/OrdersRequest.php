<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
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
           'client_id'=>'required',
           'product_id'=>'required',
           'miqdar'=>'required',

        ];
    }


    public function messages()
    {
        return [
           'client_id.required'=>'Müştəri daxil etməmisiz!',
           'product_id.required'=>'Məhsul daxil etmədiniz!',
           'miqdar.required'=>'Miqdar daxil etmədiniz!',

        ];
    }
}
