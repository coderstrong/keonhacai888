
function appAutoSize() {

    bigWidth = jQuery('.bigbet-app').width();       

    documentWidth = jQuery(document).width();       

    appPosition = (documentWidth - bigWidth) / 2;

    bigHeight = jQuery(document).height();

    var appBody = jQuery(".bigbet-app");

    var bodyPosition = appBody.position();              

    _right = bodyPosition.left;     

    rightAppHeight = bigHeight - 70;

    var wappside = 300;

    

    if(documentWidth < 1600 && documentWidth > 500){

        jQuery("#right-app").hide();

        jQuery(".app-top").hide();

        jQuery(".app-show-right").show();

        jQuery(".acc-app-block").css('right', '335px');

        jQuery(".sidebar001, #header").addClass("top0");        

        jQuery(".body-warp").css('margin-top', '70px');

        jQuery(" #wpb_widget-2, #wpb_widget-6, #wpb_widget-5").addClass('top70');

        contentWidth = bigWidth - 240;



    }

    else if(documentWidth < 500) {

        jQuery("#right-app").hide();

        jQuery(".app-top").hide();          

        jQuery(".acc-app-block").css('right', '335px');

        jQuery(".sidebar001, #header").addClass("top0");        

        jQuery(".body-warp").css('margin-top', '70px');

        contentWidth = bigWidth;

        wappside = 0;   

        jQuery(window).scroll(function() {

            if (jQuery(this).scrollTop()>0)
            {
                jQuery('.bottom-menu').fadeOut();
            }
            else
            {
                jQuery('.bottom-menu').fadeIn();
            }
        });     

    }

    else {

        jQuery("#right-app").show();

        jQuery(".app-show-right").hide();

        jQuery(".app-top").show();

        jQuery(".acc-app-block").css('right', '0');

        jQuery(".sidebar001, #header").removeClass("top0");     

        jQuery(".body-warp").css('margin-top', '140px') ;

        jQuery(" #wpb_widget-2, #wpb_widget-6, #wpb_widget-5").removeClass('top70');

        contentWidth = bigWidth - 240 - 335;

    }

    

    mainWidth = contentWidth - wappside - 75;

    wappTop2 = bigWidth - 240;

    jQuery(".app-top").css("width", bigWidth);

    jQuery("#right-app").css("right", appPosition);

    jQuery(".body-warp, .inner, #header").css('width', contentWidth);       

    jQuery(".sidebar001").css('height', bigHeight);

    jQuery("#right-app").css('height', rightAppHeight);

    jQuery("#main, #main .content").css('width', mainWidth);
    jQuery(".page-id-9380 .content .result-box").css("width", mainWidth);

    jQuery(".list-app-top-2").css("width", wappTop2)

}

function updateChatMobileSize() {

    documentWidth = jQuery(window).width();             
    bigHeight = jQuery(window).height();

    setTimeout(function(){
        jQuery(".app-chat iframe").css("height", bigHeight-50);
        jQuery(".app-chat iframe, .lich_thi_dau iframe").css("width", documentWidth);
            //jQuery(".page-id-9380 .content .result-box").css("width", documentWidth-5);
            jQuery(".m-chat a").click(function(e){
                e.preventDefault();
            })
            jQuery("#box_kqxs_minhngoc").css("background", "#fff");
            jQuery(".m-chat a").remove();
        }, 1500);


}

//auto height 
function autoiFrameHeight() {
    var heightDoc = jQuery( document ).height();
    if(heightDoc >= 2000)
    {
        heightDoc = heightDoc - 1100;
    }
    jQuery('.iframe-full-height iframe').height(heightDoc + 'px');
    // console.log(jQuery( document  ).height());
}



jQuery(document).ready(function(){

    appAutoSize();
    updateChatMobileSize();
    autoiFrameHeight();

    jQuery('.show1').click(function(){

        jQuery('#pop1').simplePopup();

    });

    jQuery(".icon-open-menu a").click(function(){            

        jQuery(".m-menu").toggle('slow');

    })



    jQuery(document).on('scroll', function() {          

            /*if(jQuery(this).scrollTop() + jQuery(this).innerHeight() >= jQuery(this)[0].scrollHeight) {

                alert('end reached');

            }*/

        })



    jQuery(".TrendingBets_wrapper_3-V a").click(function(e){

        e.preventDefault();

    });



    jQuery(".page-id-6671 article article a, .page-id-9338 article article a, .page-id-9388 article article a").click(function(e){

        e.preventDefault();

        pid = jQuery(this).attr("data-p");

        jQuery('.full-post').not("#full-content-"+pid).removeClass('show-post');



        jQuery('#full-content-'+pid).toggleClass('show-post');

        documentWidth = jQuery(document).width();

        if(documentWidth < 1600 && documentWidth > 500){ 

            _top = 70;

        }

        else if (documentWidth < 500) {

            _top = 30;

        }

        else {

            _top = 140;

        }

        jQuery('html, body').animate({

            scrollTop: jQuery("#post-"+pid).offset().top-_top

        }, 500);

    })



    jQuery('.one_third article').click(function(){

        articleID = jQuery(this).attr('id');

        _aid = articleID.split('-');

        newlink = 'http://bigbetpro.com/bai-viet/?pid='+_aid[1];

        jQuery(".image_icon_doc").attr("href",newlink);

    })



    jQuery(".m-view-chat").click(function(e){
            /*e.preventDefault();
            jQuery(".app-chat").toggle();
            jQuery(this).parent('li').toggleClass('m-active');*/
        })



})

jQuery( window ).resize(function() {

    appAutoSize();  
    updateChatMobileSize();
    // autoiFrameHeight();

})

