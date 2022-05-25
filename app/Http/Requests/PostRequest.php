<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

    // 送られてきたデータの検証
    public function rules()
    {
        return [
        // nameの中身に対しての条件
            'title'=>'required|min:3',
            'body'=>'required',
        ];
    }

        public function messages(){

        return [
            'title.required' => '値を入力してください',
            'title.min' => ':min 3文字以上の入力をお願いします',
            'body.required' => '値を入力してください。',
            ];
        }
}
