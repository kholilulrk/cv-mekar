<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubCategory extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'description', 'image'];

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

    public function categoryArticle () // nama function harus sama dengan nama model
    {
        return $this->belongsTo(CategoryArticle::class);
    }

    public function showImage ()
    {
        if (Storage::exists($this->image)) {
            return "storage/$this->image";
        }
        return asset('static/admin/img/default.png');
    }
}
