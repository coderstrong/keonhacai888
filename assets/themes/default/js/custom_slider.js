/******************************************
-   PREPARE PLACEHOLDER FOR SLIDER  -
******************************************/
var setREVStartSize=function(){
    try{var e=new Object,i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
        e.c = jQuery('#rev_slider_1_1');
        e.responsiveLevels = [1240,1024,778,480];
        e.gridwidth = [1200,1024,778,480];
        e.gridheight = [375,320,360,150];

        e.sliderLayout = "auto";
        if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})

    }catch(d){console.log("Failure at Presize of Slider:"+d)}
};

setREVStartSize();

var tpj=jQuery;

var revapi1;
tpj(document).ready(function() {
    if(tpj("#rev_slider_1_1").revolution == undefined){
        revslider_showDoubleJqueryError("#rev_slider_1_1");
    }else{
        revapi1 = tpj("#rev_slider_1_1").show().revolution({
            sliderType:"standard",
            jsFileLocation:"/plugins/revslider/js/",
            sliderLayout:"auto",
            dottedOverlay:"none",
            delay:3000,
            navigation: {
                keyboardNavigation:"on",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                mouseScrollReverse:"default",
                onHoverStop:"off",
                touch:{
                    touchenabled:"on",
                    swipe_threshold: 75,
                    swipe_min_touches: 50,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                }
                ,
                arrows: {
                    style:"",
                    enable:true,
                    hide_onmobile:true,
                    hide_under:600,
                    hide_onleave:false,
                    tmp:'',
                    left: {
                        h_align:"left",
                        v_align:"center",
                        h_offset:30,
                        v_offset:0
                    },
                    right: {
                        h_align:"right",
                        v_align:"center",
                        h_offset:30,
                        v_offset:0
                    }
                }
                ,
                bullets: {
                    enable:true,
                    hide_onmobile:true,
                    hide_under:600,
                    style:"hebe",
                    hide_onleave:false,
                    direction:"horizontal",
                    container:"layergrid",
                    h_align:"center",
                    v_align:"bottom",
                    h_offset:0,
                    v_offset:30,
                    space:5,
                    tmp:'<span class="tp-bullet-image"></span>'
                }
            },
            responsiveLevels:[1240,1024,778,480],
            visibilityLevels:[1240,1024,778,480],
            gridwidth:[1200,1024,778,480],
            gridheight:[375,320,360,150],
            lazyType:"smart",
            parallax: {
                type:"mouse",
                origo:"slidercenter",
                speed:2000,
                levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
                type:"mouse",
            },
            shadow:0,
            spinner:"off",
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
    }
}); /*ready*/


var htmlDivCss = unescape("%0A.hebe.tp-bullets%3Abefore%20%7B%0A%20%20content%3A%22%20%22%3B%0A%20%20position%3Aabsolute%3B%0A%20%20width%3A100%25%3B%0A%20%20height%3A100%25%3B%0A%20%20background%3Atransparent%3B%0A%20%20padding%3A10px%3B%0A%20%20margin-left%3A-10px%3Bmargin-top%3A-10px%3B%0A%20%20box-sizing%3Acontent-box%3B%0A%7D%0A%0A.hebe%20.tp-bullet%20%7B%0A%20%20width%3A3px%3B%0A%20%20height%3A3px%3B%0A%20%20position%3Aabsolute%3B%0A%20%20background%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%20%20%0A%20%20cursor%3A%20pointer%3B%0A%20%20border%3A5px%20solid%20rgba%280%2C%200%2C%200%2C%201%29%3B%0A%20%20border-radius%3A50%25%3B%0A%20%20box-sizing%3Acontent-box%3B%0A%20%20-webkit-perspective%3A400%3B%0A%20%20perspective%3A400%3B%0A%20%20-webkit-transform%3Atranslatez%280.01px%29%3B%0A%20%20transform%3Atranslatez%280.01px%29%3B%0A%20%20%20transition%3Aall%200.3s%3B%0A%7D%0A.hebe%20.tp-bullet%3Ahover%2C%0A.hebe%20.tp-bullet.selected%20%7B%0A%20%20background%3Argba%280%2C%200%2C%200%2C%201%29%3B%0A%20%20border-color%3Argba%28255%2C%20255%2C%20255%2C%201%29%3B%0A%7D%0A%0A.hebe%20.tp-bullet-image%20%7B%0A%20%20position%3Aabsolute%3B%0A%20%20width%3A70px%3B%0A%20%20height%3A70px%3B%0A%20%20background-position%3Acenter%20center%3B%0A%20%20background-size%3Acover%3B%0A%20%20visibility%3Ahidden%3B%0A%20%20opacity%3A0%3B%0A%20%20bottom%3A3px%3B%0A%20%20transition%3Aall%200.3s%3B%0A%20%20-webkit-transform-style%3Aflat%3B%0A%20%20transform-style%3Aflat%3B%0A%20%20perspective%3A600%3B%0A%20%20-webkit-perspective%3A600%3B%0A%20%20transform%3A%20scale%280%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20-webkit-transform%3A%20scale%280%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20transform-origin%3A0%25%20100%25%3B%0A%20%20-webkit-transform-origin%3A0%25%20100%25%3B%0A%20%20margin-bottom%3A15px%3B%0A%20border-radius%3A6px%3B%0A%7D%0A.hebe%20.tp-bullet%3Ahover%20.tp-bullet-image%20%7B%0A%20%20display%3Ablock%3B%0A%20%20opacity%3A1%3B%0A%20%20transform%3A%20scale%281%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20-webkit-transform%3A%20scale%281%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20visibility%3Avisible%3B%0A%7D%0A%0A%0A%2F%2A%20VERTICAL%20%2A%2F%0A%0A.hebe.nav-dir-vertical%20.tp-bullet-image%20%7B%0A%20%20bottom%3Aauto%3B%0A%20%20margin-right%3A15px%3B%0A%20%20margin-bottom%3A0px%3B%0A%20%20right%3A3px%3B%0A%20%20transform%3A%20scale%280%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%20%20-webkit-transform%3A%20scale%280%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%20%20transform-origin%3A100%25%200%25%3B%0A%20%20-webkit-transform-origin%3A100%25%200%25%3B%0A%7D%0A%0A.hebe.nav-dir-vertical%20.tp-bullet%3Ahover%20.tp-bullet-image%20%7B%0A%20%20transform%3A%20scale%281%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%20%20-webkit-transform%3A%20scale%281%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%7D%0A%0A%2F%2A%20VERTICAL%20LEFT%20%2A%2F%0A%0A.hebe.nav-dir-vertical.nav-pos-hor-left%20.tp-bullet-image%20%7B%0A%20%20bottom%3Aauto%3B%0A%20%20margin-left%3A15px%3B%0A%20%20margin-bottom%3A0px%3B%0A%20%20left%3A3px%3B%0A%20%20transform%3A%20scale%280%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%20%20-webkit-transform%3A%20scale%280%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%20%20transform-origin%3A0%25%200%25%3B%0A%20%20-webkit-transform-origin%3A0%25%200%25%3B%0A%7D%0A%0A.hebe.nav-dir-vertical.nav-pos-hor-left%20.tp-bullet%3Ahover%20.tp-bullet-image%20%7B%0A%20%20transform%3A%20scale%281%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%20%20-webkit-transform%3A%20scale%281%29%20translateX%280px%29%20translateY%28-50%25%29%3B%0A%7D%0A%0A%2F%2A%20HORIZONTAL%20TOP%20%2A%2F%0A.hebe.nav-pos-ver-top.nav-dir-horizontal%20.tp-bullet-image%20%7B%0A%20%20bottom%3Aauto%3B%0A%20%20top%3A3px%3B%0A%20%20transform%3A%20scale%280%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20-webkit-transform%3A%20scale%280%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20transform-origin%3A0%25%200%25%3B%0A%20%20-webkit-transform-origin%3A0%25%200%25%3B%0A%20%20margin-top%3A15px%3B%0A%20%20margin-bottom%3A0px%3B%20%20%0A%7D%0A.hebe.nav-pos-ver-top.nav-dir-horizontal%20.tp-bullet%3Ahover%20.tp-bullet-image%20%7B%0A%20%20transform%3A%20scale%281%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%20%20-webkit-transform%3A%20scale%281%29%20translateX%28-50%25%29%20translateY%280%25%29%3B%0A%7D%0A");
var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
if(htmlDiv) {
    htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
}
else
{
    var htmlDiv = document.createElement('div');
    htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
    document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
}