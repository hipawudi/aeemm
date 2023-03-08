<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Organization;

class Member extends Model
{
    use HasFactory;

    public function createUser(): User
    {
        $user = new User();

        $user->email = $this->email;
        $user->name = $this->first_name;
        $user->password = 'need-to-set';

        $user->save();

        return $user;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasUser()
    {
        return $this->user()->exists();
    }

    public function organizations(){
        return $this->belongsToMany(Organization::class);
    }

    public function belongsToOrganization($organization){
        return $this->belongsToMany(Organization::class)->wherePivot('organization_id', $organization->id);
    }
}
