<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormsRequest extends FormRequest
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
            'name'         => 'required|unique:forms,name,'. $this->form.',id',
            'status'       => 'required',
            'fieldLabel'   => 'required|array',
            'fieldLabel.*' => 'required|string',
            'fieldType'    => 'required|array',
            'fieldType.*'  => 'required|string',
            // 'fieldValues.*' =>'required_if:|array',

            // 'required_if:asset_type_id,4

        ];
    }
}
