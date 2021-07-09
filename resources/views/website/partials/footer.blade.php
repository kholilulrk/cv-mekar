<footer class="footer gray-footer page-section-pt gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <h6 class="text-white mb-30 mt-10 text-uppercase">About Us</h6>
                <img src="{{ asset($setting->showlogo()) }}" alt="" class="img-fluid img-footer">
                <p>{{ $setting->short_description }}</p>
            </div>
            <div class="col-lg-4 col-sm-6 sm-mb-30">
                <div class="footer-useful-link footer-hedding">
                    <h6 class="text-white mb-30 mt-10 text-uppercase">Navigation</h6>
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            <ul class="menu-links">
                                <li><a href="{{ ($menu=='SubGallery') ? route('landing.index'):'' }}#homesection">Home</a></li>
                                <li><a href="{{ ($menu=='SubGallery') ? route('landing.index'):'' }}#why-us">Why Us</a></li>
                                <li><a href="{{ ($menu=='SubGallery') ? route('landing.index'):'' }}#about-us">About Us</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 px-3 mt-3">
                            <ul class="menu-links">
                                <li><a href="{{ ($menu=='SubGallery') ? route('landing.index'):'' }}#portfolio">Album</a></li>
                                <li><a href="{{ ($menu=='SubGallery') ? route('landing.index'):'' }}#services">Service</a></li>
                                <li><a href="{{ ($menu=='SubGallery') ? route('landing.index'):'' }}#contact-us">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 xs-mb-30">
                <h6 class="text-white mb-30 mt-10 text-uppercase">Contact Us</h6>
                <ul class="addresss-info">
                    <li><i class="fa fa-map-marker"></i> <p>{{ $contact->address }}</p> </li>
                    <li><i class="fa fa-phone"></i> <a href="tel:7042791249"> <span>{{ $contact->phone }} </span> </a> </li>
                    <li><i class="fa fa-envelope-o"></i>Email: {{ $contact->email }}</li>
                </ul>
            </div>
        </div>
        <div class="footer-widget">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <p class="mt-15">&copy;Copyright 2020<a href="javascript:void(0)"> {{ $setting->title }} </a> | <a href="https://aksamedia.co.id/" target="_blank">Jasa Pembuatan website</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
