<!DOCTYPE html>
<html lang="en">

<head>
    @include('website.partials.metadata')
    @include('website.partials.styles')
</head>

<body>

    <div class="wrapper">

        <!--=================================
        preloader -->

        <div id="pre-loader">
            <img src="{{asset('images/pre-loader/loader-13.svg')}}" alt="">
        </div>

        <!--=================================
        preloader -->

        <section id="homesection"></section>

        <!--=================================
        header -->
        @include('website.partials.header_gallery')
        <!--=================================
        header -->


        <!--=================================
        banner -->
            @yield('content')
        <!--=================================
        video -->


        <!--=================================
        footer -->
        @include('website.partials.footer')
        <!--=================================
        footer -->
    </div>

    <div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-angle-up"></i> <span>TOP</span></a></div>

    <!--=================================
    cta -->
    @include('website.partials.cta')
    <!--=================================
    cta -->

    <!--=================================
    jquery -->
    @include('website.partials.scripts')



</body>

</html>
