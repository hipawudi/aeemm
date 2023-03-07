<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminUser;

class Organization extends Model
{
    use HasFactory;

    public function adminUsers(){
        return $this->belongsToMany(AdminUser::class);
    }

    public function members(){
        return $this->belongsToMany(Member::class);
    }
}
