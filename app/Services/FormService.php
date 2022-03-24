<?php

namespace App\Services;

use App\Models\FormElementType;
use App\Models\Form;
use App\Models\FormElement;
use App\Models\FormElementListValue;
use DB;

class FormService
{

    public function __construct()
    {
        $this->selectTypeId = optional(FormElementType::whereName('Select')->first())->id;
    }
    public function saveData()
    {
        $this->beginTransaction();
        try {
            $formId = $this->saveFormData();
            $this->saveFormFields($formId);

            $this->commit();

            return ['status' => 'success', 'message' => "Form Data added"];
        } catch (\Exception $e) {
            $this->rollback();
            return  ['status' => 'error', 'message' => "something went wrong, Please Try again"];
        }
    }

    public function beginTransaction()
    {
        DB::beginTransaction();
    }

    public function commit()
    {
        DB::commit();
    }

    public function rollback()
    {
        DB::rollback();
    }

    public function saveFormData($id = null)
    {
        $data = [
            'name'   => request('name'),
            'status' => request('status'),
        ];

        if (!$id) {
            $form = Form::create($data);
            return $form->id;
        }

        Form::find($id)->update($data);
    }

    public function saveFormFields($formId)
    {

        $formFields = request('fieldLabel');
        $fieldType  = request('fieldType');
        foreach ($formFields as $key => $formField) {
            $field = FormElement::create([
                'form_id'              => $formId,
                'form_element_type_id' => $fieldType[$key],
                'label'                => $formField
            ]);

            if ($fieldType[$key] == $this->selectTypeId) {
                $this->saveSelectOptions($field->id, $key);
            }
        }
    }

    public function saveSelectOptions($fieldId, $key)
    {
        $value   = request('fieldValues');
        $options = explode(',', $value[$key]);

        foreach ($options as $option) {
            FormElementListValue::create([
                'form_element_id' => $fieldId,
                'value' => $option
            ]);
        }
    }

    public function updateData($id)
    {
        $this->beginTransaction();
        try {
            $this->saveFormData($id);
            $this->updateFormFields($id);
            $this->commit();

            return ['status' => 'success', 'message' => "Form - ".request('name')." Data updated"];
        } catch (\Exception $e) {
            $this->rollback();

            return  ['status' => 'error', 'message' => "something went wrong, Please Try again"];
        }
    }

    public function updateFormFields($id)
    {
        $formIds = array_filter(request('fieldId'));
        $this->deleteFields($id);

        $formFields = request('fieldLabel');
        $fieldType  = request('fieldType');
        foreach ($formFields as $key => $formField) {
            $updateData = [
                'form_id'              => $id,
                'form_element_type_id' => $fieldType[$key],
                'label'                => $formField
            ];

            if (isset($formIds[$key])) {
                FormElement::find($formIds[$key])->update($updateData);
                $fieldId = $formIds[$key];
            } else {
                $field = FormElement::create($updateData);
                $fieldId = $field->id;
            }

            if ($fieldType[$key] == $this->selectTypeId) {
                $this->updateSelectOptions($fieldId, $key);
            }
        }
    }

    public function deleteFields($id)
    {
        $formIds = array_filter(request('fieldId'));

        $query = FormElement::where('form_id', $id);
        if (count($formIds) > 0) {
            $query = $query->whereNotIn('id', $formIds);
        }
        $query->delete();
    }

    public function updateSelectOptions($fieldId, $key)
    {
        $value   = request('fieldValues');
        $options = explode(',', $value[$key]);

        FormElementListValue::where('form_element_id', $fieldId)->whereNotIn('value', $options)->delete();

        foreach ($options as $option) {
            FormElementListValue::updateOrCreate([
                'form_element_id' => $fieldId,
                'value' => $option
            ], [
                'form_element_id' => $fieldId,
                'value' => $option
            ]);
        }
    }
}
