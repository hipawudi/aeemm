<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable=['user_id','name_zh','name_fn','nickname','mobile','gender','dob','address','email','state'];

    public function offers(){
        return $this->belongsToMany(Offer::class);
    }
}
