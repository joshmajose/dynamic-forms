<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormElement extends Model
{
    protected $guarded = [];

    public function formElementType()
    {
        return $this->belongsTo('App\Models\FormElementType');
    }

    public function form()
    {
        return $this->belongsTo('App\Models\Form');
    }

    public function formElementListValues()
    {
        return $this->hasMany('App\Models\FormElementListValue');
    }
}
