<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable=['course_id','code','title_zh','title_en','apply_start','apply_end','course_start','course_end','price','early_price','member_price','description','remark','publish'];
    protected $appends=['code'];

    public function getCodeAttribute(){
        return Course::find($this->course_id)->code;
    }

    public function students(){
        return $this->belongsToMany(Student::class)->withPivot('score');
    }
    static function availables(){
        return Offer::where('publish',true)->get();
    }
}
