<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostFormRequest extends FormRequest
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
        if(Request::has("over_name")){
            return [
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
                'comment'         => 'required|max:2500|string',
            ];
        }
        if(Request::has("post_category_id")){
            return [
                'post_title' => 'min:4|max:50',
                'post_body'  => 'min:10|max:500',
            ];
        }
        if(Request::has("main_category_name")){
            return [
                'main_category_name' => 'required|max:100|string|unique:main_categories,main_category',
            ];
        }

        if (Request::has("sub_category_name")) {
            return [
                'main_category_id'  => 'required|exists:main_categories,id',
                'sub_category_name' => 'required|max:100|string|unique:sub_categories,sub_category',
            ];
        }

        return [];

    }

    public function messages(){
        return [
            'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは50文字以内で入力してください。',
            'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.max' => '最大文字数は500文字です。',
        ];
    }
}
