@section('styles')
<style type="text/css">
    .feature-icon img.icon{
        width: 50px;
        height: 50px;
    }
</style>
@stop

<section class="service white-bg page-section-pt" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h6>We're Good At </h6>
                    <h2 class="title-effect">Our Service</h2>
                    <p>Know what we can do for you</p>
                </div>
            </div>
        </div>
        <!-- =========================================== -->
        <div class="row justify-content-center">
            @foreach ($service as $data)
            <div class="col-lg-4 col-md-4 mb-30">
                <div class="feature-text box-shadow h-100 text-center">
                    <div class="feature-icon mb-3">
                        <img src="{{$data->showimage()}}" class="icon rounded img-thumbnail">
                    </div>
                    <div class="feature-info">
                        <h4 class="pb-10">{{ $data->title }}</h4>
                        <p>{{ str_limit(strip_tags($data->description), 50) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
