<section class="page-section-pt" id="about-us">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h6>Know us better</h6>
                    <h2 class="title-effect">About Us</h2>
                    <p>Who we are and what we do</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <img class="img-fluid center-img-vertical" src="{{ asset($setting->showLogo()) }}" alt="">
            </div>
            <div class="col-lg-5 sm-mt-30 pr-4">
                <div class="section-title">
                    <h2 class="title-effect">{{ $setting->title }}</h2>
                    <p> {{ $setting->short_description }} </p>
                </div>
                <p> {!! $setting->description !!} </p>
            </div>
        </div>
    </div>
</section>
