<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MemberPayment extends Model
{
    use HasFactory;

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return $this->payment_image_path ? Storage::url($this->payment_image_path) : '';
    }
}
