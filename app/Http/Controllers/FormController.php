<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormElementType;
use App\Http\Requests\StoreFormsRequest;
use App\Http\Requests\UpdateFormsRequest;
use App\Models\Form;
use App\Services\FormService;

class FormController extends Controller
{
    public function __construct(FormService $formService)
    {
        $this->formService = $formService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formsList = Form::withCount('formElements')->get();

        return view('forms.list', compact('formsList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $elementTypes = FormElementType::all();

        return view('forms.create', compact('elementTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormsRequest $request)
    {
        $result = $this->formService->saveData();
        if ($result['status'] == 'error') {
            return redirect(route('forms.create'))->withInput()->with('error', $result['message']);
        }

        return redirect(route('forms.index'))->with('message', $result['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data         = Form::with(['formElements', 'formElements.formElementType', 'formElements.formElementListValues'])->findOrFail($id);
        $elementTypes = FormElementType::all();

        return view('forms.edit', compact('data', 'elementTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormsRequest $request, $id)
    {
        $result = $this->formService->updateData($id);
        if ($result['status'] == 'error') {
            return redirect(route('forms.edit',$id))->withInput()->with('error', $result['message']);
        }

        return redirect(route('forms.index'))->with('message', $result['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Form::findOrFail($id)->delete();
        
        return redirect(route('forms.index'))->with('message','Selected Form details deleted Successfully');
    }
}
