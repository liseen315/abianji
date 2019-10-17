<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'required|unique:categories|min:2|max:10',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '分类名',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '分类名必填',
            'name.unique' => '不能重复添加分类',
            'name.min' => '不能输入小于2个字符',
            'name.max' => '不能输入大于10个字符',
        ];
    }
}
