<section id="portfolio" class="portfolio page-section-pt wihte-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h6>Our Memories </h6>
                    <h2 class="title-effect">Galleries</h2>
                    <p>Peek at our good memories</p>
                </div>
            </div>
        </div>
        <div class="row popup-gallery columns-4 no-title justify-content-center">
            @foreach ($category_galleries as $galleries)
            <div class="col-lg-3 my-3">
                <div class="portfolio-item">
                    <img src="{{ asset($galleries->showImage()) }}" alt="" class="responsive-img">
                    <div class="portfolio-overlay" style="height:250px;">
                        <h4 class="text-white">
                            <a href="{{ route('gallery.sub_gallery', $galleries->slug) }}"> {{ $galleries->name }} </a>
                        </h4>
                        <p>{{ str_limit(strip_tags($galleries->description), 100) }}</p>
                        <span class="text-white">
                            <a href="{{ route('gallery.sub_gallery', $galleries->slug) }}"> Selengkapnya... </a>
                        </span>
                    </div>
                    <a class="popup portfolio-img" href="{{ asset($galleries->showImage()) }}">
                        <i class="fa fa-arrows-alt"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
