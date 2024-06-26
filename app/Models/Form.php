<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Form extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    
    protected $appends = [
        'wait_count'
    ];
    public function application()
    {
        return $this->hasMany(FormApplication::class);
    }
    public function getWaitCountAttribute()
    {
        return $this->hasMany(FormApplication::class)->where('state', 0)->orWhere('state', 2)->count();
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function fields()
    {
        return $this->hasMany(FormField::class, '');
    }
    public function hasChild()
    {
        return $this->fields()->exists();
    }
    public function hasCourse()
    {
        return $this->course()->exists();
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->useDisk('media');
    }
}
