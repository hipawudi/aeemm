<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable=['code','area','category','title_zh','title_en','description','price','early_price','member_price','sessions','hours','quota','discount','valid'];
}
