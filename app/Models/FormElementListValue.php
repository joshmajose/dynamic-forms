<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormElementListValue extends Model
{
    protected $guarded = [];

    public function formElement()
    {
        return $this->belongsTo('App\Models\FormElement');
    }
}
