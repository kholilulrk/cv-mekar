<header id="header" class="header text-dark">
    <div class="menu onepage-hover-01">
        <!-- menu start -->
        <nav id="menu" class="mega-menu">
            <!-- menu list items container -->
            <section class="menu-list-items">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <!-- menu logo -->
                            <ul class="menu-logo">
                                <li>
                                    <a href="{{ route('landing.index') }}"><img id="logo_img"
                                            src=" {{asset($setting->showLogo())}} " alt="logo"> </a>
                                </li>
                            </ul>
                            <!-- menu links -->
                            <div class="menu-bar">
                                <ul class="menu-links">
                                    <li><a href="{{ route('landing.index') }}#homesection">Home</a></li>
                                    <li><a href="{{ route('landing.index') }}#why-us">Why Us</a></li>
                                    <li><a href="{{ route('landing.index') }}#about-us">About us</a></li>
                                    <li class="active"><a href="{{ route('landing.index') }}#portfolio">Album</a></li>
                                    <li><a href="{{ route('landing.index') }}#services">Services</a></li>
                                    <li><a href="{{ route('landing.index') }}#contact-us">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </nav>
        <!-- menu end -->
    </div>
</header>
