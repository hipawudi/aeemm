<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable=['offer_id','student_id','id_type','id_num','name_zh','name_fn','gender','dob','mobile','email'];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    protected static function booted(){
        static::created(function ($application){
            if(empty($application->student_id)){
                $student=new Student();
                $student->id_type=$application->id_type;
                $student->id_num=$application->id_num;
                $student->name_zh=$application->name_zh;
                $student->name_fn=$application->name_fn;
                $student->gender=$application->gender;
                $student->dob=$application->dob;
                $student->mobile=$application->mobile;
                $student->email=$application->email;
                $student->newbie=true;
                $student->save();
                $application->student_id=$student->id;
                $application->update();
            }

            $offerStudent=new OfferStudent();
            $offerStudent->offer_id=$application->offer_id;
            $offerStudent->student_id=$application->student_id;
            $offerStudent->save();

        });
    }
}
