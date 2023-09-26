<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;
    use Notifiable;

    public function createUser(): User
    {
        $user = new User();

        $user->email = $this->email;
        $user->name = $this->name_zh;
        $user->password = 'need-to-set';
        $user->assignRole('member');
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
    public function certificates()
    {
        return $this->belongsToMany(Certificate::class, 'professionals', 'member_id', 'certificate_id')->withPivot(
            'id',
            'display_name',
            'number',
            'number_display',
            'issue_date',
            'valid_from',
            'valid_until',
            'authorize_by',
            'rank',
            'avata'
        );
    }
    public function routeNotificationForMail(Notification $notification)
    {
        return [$this->email => $this->name_zh];
    }
}
