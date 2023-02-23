<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable=['offer_id','student_id','id_type','id_num','name_zh','name_fn','gender','dob','mobile'];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
