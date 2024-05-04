<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{

    /**
     * @var string
     */
    protected $formModel = '';

    /**
     * Rewrite validationData
     * custom the post form parameters.
     *
     * @return array|string
     */
    public function validationData()
    {
        if ($this->formModel != '') {
            // If the formModel is customized.
            return $this->post($this->formModel);
        }
        return $this->all();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
