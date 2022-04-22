<?php

namespace App\Http\Requests;


class SystemConfigRequest extends BaseRequest
{
    /**
     * Define the form model of this request.
     *
     * @var string
     */
    protected $formModel = 'SystemConfigModel';

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
            'code'          => 'required|unique:system_config,code|max:40'
        ];
//        switch($this->method())
//        {
//            case 'GET':
//            case 'DELETE':
//                {
//                    return [];
//                }
//
//            // Create
//            case 'POST':
//                {
//                    return [
//                        'code'          => 'required|max:40|unique:system_config'
//                    ];
//                }
//
//            // UPDATE
//            case 'PUT':
////            case 'PATCH':
////                {
////                    $blog = SystemConfig::findOrFail($this->route('id'));
////                    return [
////                        'code'            => 'between:2,5|required|unique:system_config,code,'.$blog->id,
////                    ];
////                }
//            default:break;
//        }
    }
}
