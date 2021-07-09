<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryGallery extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'url', 'description', 'type'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function scopeImage ($query)
    {
        return $query->where('type', 'image');
    }

    public function scopeVideo ($query)
    {
        return $query->where('type', 'video');
    }

    public function showImage ()
    {
        if (Storage::exists($this->url)) {
            return "storage/$this->url";
        }
        return asset('static/admin/img/default.png');
    }

    public function showPreview ()
    {
        $url = str_replace("https://www.youtube.com/watch?v=", "https://img.youtube.com/vi/", $this->url);
        return $url.'/mqdefault.jpg';
    }
}
