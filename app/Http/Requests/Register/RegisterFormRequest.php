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
        $old_year = $this->input('old_year');
        $old_month = $this->input('old_month');
        $old_day = $this->input('old_day');
        $datetime = $old_year . '-' . $old_month . '-' . $old_day;
        $this->merge(['datetime' => $datetime]);

        return [
            //
            'over_name'       => 'required|string|max:10',
            'under_name'      => 'required|string|max:10',
            'over_name_kana'  => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'mail_address'    => 'required|email|unique:users|max:100',
            'sex'             => 'required',
            'datetime' => 'required|after_or_equal:2000-01-01|before_or_equal:'.date('Y-m-d'),
            'role'            => 'required',
            'password'        => 'required|min:8|max:30|confirmed',
        ];
    }
}
