<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable=['survey_id','sequence','field_name','title_cn','title_en','option_cn','option_en','other','other_label','format','rule','mandatory'];

    public function survey(){
        return $this->belongsTo(Survey::class);
    }
}
