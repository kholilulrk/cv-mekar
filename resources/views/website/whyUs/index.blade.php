@section('styles')
<style type="text/css">
    .feature-icon img.icon{
        width: 50px;
        height: 50px;
    }
</style>
@stop

<section id="why-us" class="page-section-pt white-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <h6>We're Best At </h6>
                    <h2 class="title-effect">Why Us</h2>
                    <p>We'll do everything we can to make our next best project!</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($whyus as $data)
            <div class="col-lg-3 col-sm-6 sm-mb-30">
                <div class="feature-text round shadow">
                    <div class="feature-icon mb-3">
                        <img src="{{$data->showimage()}}" class="icon rounded">
                    </div>
                    <div class="feature-info">
                        <h5 class="text-back"> {{ $data->title }} </h5>
                        <p> {!! $data->description !!} </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
