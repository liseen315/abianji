<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
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
            'category_id' => 'required',
            'title' => 'required|min:2|max:255',
            'markdown' => 'required',
            'tag_list' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => '分类',
            'title' => '标题',
            'markdown' => '文章内容',
            'tag_list' => '标签'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => '分类名必填',
            'title.required' => '标题必填',
            'title.min' => '标题不能少于2个字符',
            'title:max' => '标题过长',
            'markdown.required' => '内容必填',
            'tag_list.required' => '至少填加一个标签'
        ];
    }
}
