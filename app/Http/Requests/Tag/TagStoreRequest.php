<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class TagStoreRequest extends FormRequest
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
            'name' => 'required|unique:tags',
        ];
    }

    /**
     * 定义字段中文名字
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '标签名',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '标签名必填',
            'name.unique' => '不能重复添加标签',
        ];
    }
}
