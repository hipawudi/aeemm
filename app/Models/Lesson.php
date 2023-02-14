<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $appends= ['offer_code','teacher_name'];
    
    public function getOfferCodeAttribute(){
        return Offer::find($this->offer_id)->code;
    }
    public function getTeacherNameAttribute(){
        return Teacher::find($this->teacher_id);
    }
}
