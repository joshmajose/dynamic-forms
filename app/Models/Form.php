<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = [];

    public function formElements()
    {
        return $this->hasMany('App\Models\FormElement');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
