<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable=['course_id','code','title_zh','title_en','apply_start','apply_end','course_start','course_end','price','early_price','member_price','description','remark','publish'];
}
