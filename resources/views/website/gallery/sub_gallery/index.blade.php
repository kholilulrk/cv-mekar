@extends('website.gallery.layout_gallery')

@section('content')

<section class="page-section-pt" id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <img class="img-fluid center-img-vertical" src="{{ asset($category_gallery->showImage()) }}" alt="">
            </div>
            <div class="col-lg-5 sm-mt-30">
                <div class="section-title">
                    <h2 class="title-effect">{{ $category_gallery->name }}</h2>
                </div>
                <p> {{ strip_tags($category_gallery->description) }} </p>
            </div>
        </div>
    </div>
</section>

<section id="portfolio" class="portfolio page-section-ptb wihte-bg">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title text-center">
                    <h6>Our Portfolio</h6>
                    <h2>Galleries - {{ $category_gallery->name }}</h2>
                </div>
            </div>
        </div>
        <div class="row popup-gallery columns-4 no-title justify-content-center">
            @foreach ($sub_gallery as $galleries)
            <div class="col-lg-6 my-3">
                <div class="portfolio-item">
                    <img src="{{ asset($galleries->showImage()) }}" alt="" class="responsive-img">
                    <div class="portfolio-overlay">
                        <h4 class="text-white">{{ $galleries->title }}</h4>
                        <div class="pr-3">
                            {!! $galleries->description !!}
                        </div>
                    </div>
                    <a class="popup portfolio-img" href="{{asset( $galleries->showImage() )}}">
                        <i class="fa fa-arrows-alt"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
