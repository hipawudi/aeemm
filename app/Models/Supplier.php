<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable=[
        'name_zh',
        'name_pt',
        'email',
        'phone',
        'address',
        'categories',
        'registed_date',
        'disproved_date',
        'remark',
        'active',
    ];

}
