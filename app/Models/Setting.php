<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['title', 'author', 'keyword', 'short_description', 'description', 'fb_pixel', 'google_analytic', 'icon', 'logo', 'logo_grayscale', 'date'];
    public function showIcon ()
    {
        if (Storage::exists($this->icon)) {
            return "storage/$this->icon";
        }
        return asset('static/admin/img/default.png');
    }

    public function showPreview ()
    {
        $url = str_replace("https://www.youtube.com/watch?v=", "https://img.youtube.com/vi/", $this->url);
        return $url.'/mqdefault.jpg';
    }

    public function showLogo ()
    {
        if (Storage::exists($this->logo)) {
            return "storage/$this->logo";
        }
        return asset('static/admin/img/default.png');
    }

    public function showLogoGrayscale ()
    {
        if (Storage::exists($this->logo_grayscale)) {
            return "storage/$this->logo_grayscale";
        }
        return asset('static/admin/img/default.png');
    }
}
