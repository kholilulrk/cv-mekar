$('#rev_slider_263_1').show().revolution({
    sliderType:"standard",
    sliderLayout:"fullwidth",
    dottedOverlay:"none",
    delay:5000,
    navigation: {
        keyboardNavigation:"off",
        keyboard_direction: "horizontal",
        mouseScrollNavigation:"off",
        mouseScrollReverse:"default",
        onHoverStop:"off",
        touch:{
            touchenabled:"on",
            touchOnDesktop:"off",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false
        },
        arrows: {
            style:"gyges",
            enable:true,
            hide_onmobile:true,
            hide_under:767,
            hide_onleave:false,
            tmp:'',
            left: {
                h_align:"left",
                v_align:"center",
                h_offset:20,
                v_offset:0
            },
            right: {
                h_align:"right",
                v_align:"center",
                h_offset:20,
                v_offset:0
            }
        }
    },
    visibilityLevels:[1240,1024,778,480],
    gridwidth:1270,
    gridheight:500,
    lazyType:"none",
    shadow:0,
    spinner:"spinner2",
    stopLoop:"off",
    stopAfterLoops:-1,
    stopAtSlide:-1,
    shuffle:"off",
    autoHeight:"off",
    disableProgressBar:"on",
    hideThumbsOnMobile:"off",
    hideSliderAtLimit:0,
    hideCaptionAtLimit:0,
    hideAllCaptionAtLilmit:0,
    debugMode:false,
    fallbacks: {
        simplifyAll:"off",
        nextSlideOnWindowFocus:"off",
        disableFocusListener:false,
    }
});
