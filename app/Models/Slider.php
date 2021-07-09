<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    protected $fillable = ['title', 'description', 'url'];

    public function showImage ()
    {
        if (Storage::exists($this->url)) {
            return "storage/$this->url";
        }
        return asset('static/admin/img/default.png');
    }
}
