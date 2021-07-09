<?php

namespace App\Http\Middleware;

// use App\Models\CallForPaper;
use App\Models\CategoryGallery;
// use App\Models\CategoryArticle;
// use App\Models\CategoryEvent;
// use App\Models\Committee;
use App\Models\Service;
use App\Models\Contact;
use App\Models\Registration;
use App\Models\Setting;
use App\Models\Slider;
// use App\Models\SocialMedia;
use Closure;
use Illuminate\Support\Facades\View;

class GlobalVariable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data['service']        = Service::all();
        // $data['categoryArticles'] = CategoryArticle::all();
        $data['cat_galleries'] = CategoryGallery::all();
        $data['contact'] = Contact::find(1);
        $data['setting'] = Setting::find(1);
        $data['cat_find'] = CategoryGallery::find(1);
        $data['meta'] = $data['setting'];
        // $data['socialMedia'] = SocialMedia::all();
        View::share($data);
        return $next($request);
    }
}
