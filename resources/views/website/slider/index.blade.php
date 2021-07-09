<section class="rev-slider" style="z-index: 99;">
    <div id="rev_slider_263_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="webster-construction" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
        <!-- START REVOLUTION SLIDER 5.4.6.3 fullwidth mode -->
        <div id="rev_slider_263_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.6.3">
            <ul>
                @foreach($sliders as $slider)
                    <li data-index="rs-747-{{$slider->id}}" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="{{ asset($slider->showimage()) }}"  data-rotate="0"  data-saveperformance="off"  data-title="Slide">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset($slider->showimage()) }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                    </li>
                @endforeach
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div> </div>
    </div>
</section>
