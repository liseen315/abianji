<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            'email' => 'required|string',
            'password' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [
            'email' => '邮箱',
            'password' => '密码'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '邮箱必填',
            'password.required' => '密码必填'
        ];
    }
}
