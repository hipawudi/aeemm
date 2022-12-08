<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function klass(){
        return $this->belongsTo(Klass::class);
    }

    public function scores(){
        return $this->hasMany(Score::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class,'scores','klassmate_id','course_id');
    }
}