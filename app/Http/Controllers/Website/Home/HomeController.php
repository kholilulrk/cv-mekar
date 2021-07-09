<?php

namespace App\Http\Controllers\Website\Home;

use App\Models\Gallery;
use App\Models\CategoryGallery;
use App\Models\Service;
use App\Models\Slider;
use App\Models\WhyUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'Home');
    }

    public function index(){
        $data['service']        = Service::all();
        $data['whyus']          = WhyUs::all();
        $data['sliders']        = Slider::latest()->get();
        $data['category_galleries']        = CategoryGallery::all();
        // $data['fitur']          = Fitur::inRandomOrder()->take(6)->get();
        // $data['galleries']      = Gallery::image()->inRandomOrder()->take(6)->get();

        return view('website.home.index', $data);
    }
}
