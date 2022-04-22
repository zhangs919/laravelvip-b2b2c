<?php

namespace App\Http\Requests;


class RegionRequest extends BaseRequest
{

    /**
     * Define the form model of this request.
     *
     * @var string
     */
    protected $formModel = '';

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
            'region_name' => 'required|max:30',
//            'region_code' => 'required|string|max:30',
            'sort' => 'required|between:0,255',
            'level' => 'integer',
            'is_enable' => 'integer',
            'parent_code' => 'max:30'
        ];
    }


}
