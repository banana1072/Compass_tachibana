<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
        return [
            //
            'over_name'       => 'required|string|max:10',
            'under_name'      => 'required|string|max:10',
            'over_name_kana'  => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'mail_address'    => 'required|email|unique:users|max:100',
            'sex'             => 'required',
            'old_year'        => 'required|numeric|min:2000',
            'old_month'       => 'required|numeric|min:1',
            'old_day'         => 'required|numeric|min:1',
            'role'            => 'required',
            'password'        => 'required|min:8|max:30|confirmed',
        ];
    }
}
