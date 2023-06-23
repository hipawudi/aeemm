<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FormApplication extends Model
{
    use HasFactory;
    protected $appends = ['url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function form()
    {
        return $this->belongsTo(Form::class)->with('fields');
        //return $this->hasMany(FormApplicationField::class);
    }
    public function fields()
    {
        return $this->hasMany(FormApplicationField::class);
    }
    public function getUrlAttribute()
    {
        return $this->images_path ? Storage::url($this->images_path) : '';
    }
}
