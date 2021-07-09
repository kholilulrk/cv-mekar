<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class WhyUs extends Model
{
    protected $table='whyUses';
    protected $fillable=['title','description','icon'];

    public function showImage ()
    {
        if (Storage::exists($this->icon)) {
            return "storage/$this->icon";
        }
        return asset('static/admin/img/default.png');
    }
}
