<?php

namespace App\Http\Requests;


class ArticleCatRequest extends BaseRequest
{
    /**
     * Define the form model of this request.
     *
     * @var string
     */
    protected $formModel = 'ArticleCatModel';
    
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
            'cat_name' => 'required|max:10',
            'cat_model' => 'required',
            'parent_id' => 'required',
            'cat_sort' => 'required|max:255',
            'cat_image' => 'max:255',
        ];
    }
}
