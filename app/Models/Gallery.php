<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    protected $fillable = ['title', 'category_gallery_id', 'description', 'url', 'type'];

    public function categoryGallery ()
    {
        return $this->belongsTo(CategoryGallery::class);
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

    public function scopeImage ($query)
    {
        return $query->where('type', 'image');
    }

    public function scopeVideo ($query)
    {
        return $query->where('type', 'video');
    }

    public function scopeExhibition ($query)
    {
        return $query->where('type', 'exhibition');
    }
}
