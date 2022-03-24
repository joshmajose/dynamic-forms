<?php

namespace App\Http\Controllers;

use App\Models\Form;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $formsList = Form::with(['formElements', 'formElements.formElementType', 'formElements.formElementListValues'])->active()->get();

        return view('welcome', compact('formsList'));
    }
}
