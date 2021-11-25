
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var headerMobile = $('.wrap-header-mobile');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(headerMobile).addClass('fix-menu-mobile');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(headerMobile).removeClass('fix-menu-mobile');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(headerMobile).addClass('fix-menu-mobile');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(headerMobile).removeClass('fix-menu-mobile');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }
    $('body').on('click', '.active-sub-menu-m', function(event) {
        $(this).find('.sub-menu-m').toggle();
    });
    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click',function(){
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });
    /*==================================================================
    [ Favorite ]*/
    $('.js-show-favorite').on('click',function(){
        $('.js-panel-favorite').addClass('show-header-cart');
    });

    $('.js-hide-favorite').on('click',function(){
        $('.js-panel-favorite').removeClass('show-header-cart');
    });
    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });
    
    /*==================================================================
    [ Show modal1 ]*/
    $('body').on('click','.js-show-modal1',function(e){
        e.preventDefault();
        $('.show-modal').removeClass('show-modal');
        $('.js-modal1').addClass('show-modal');
    });

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal');
        $('.quick_view_detail_product').html('<div class="flex-c-m"><i class="fa fa-spinner fa-spin"></i></div>');
    });
    /*==================================================================
    [ Show modal login ]*/
    $('.js-show-modal-login').on('click',function(e){
        e.preventDefault();
        $('.show-modal').removeClass('show-modal');
        $('.js-modal-login').addClass('show-modal');
    });

    $('.js-hide-modal-login').on('click',function(){
        $('.js-modal-login').removeClass('show-modal');
    });
    /*==================================================================
    [ Show modal register ]*/
    $('.js-show-modal-register').on('click',function(e){
        e.preventDefault();
        $('.show-modal').removeClass('show-modal');
        $('.js-modal-register').addClass('show-modal');
    });

    $('.js-hide-modal-register').on('click',function(){
        $('.js-modal-register').removeClass('show-modal');
    });
    /*==================================================================
    [ Show modal forgot ]*/
    $('.js-show-modal-forgot').on('click',function(e){
        e.preventDefault();
        $('.show-modal').removeClass('show-modal');
        $('.js-modal-forgot').addClass('show-modal');
    });

    $('.js-hide-modal-forgot').on('click',function(){
        $('.js-modal-forgot').removeClass('show-modal');
    });
    /*==================================================================
    [ Show modal reset ]*/
    $('.js-show-modal-reset').on('click',function(e){
        e.preventDefault();
        $('.show-modal').removeClass('show-modal');
        $('.js-modal-reset').addClass('show-modal');
    });

    $('.js-hide-modal-reset').on('click',function(){
        $('.js-modal-reset').removeClass('show-modal');
    });

})(jQuery);
function changeF(min,max) {    
    document.getElementById('filter_price').value = min+'-'+max;
}
function initSliders(start,end,min,max,prefix,elm) {
    var slider2 = document.getElementById(elm);
    var input0 = document.getElementById('price_min');
    var input1 = document.getElementById('price_max');
    var inputs = [input0, input1];

    noUiSlider.create(slider2, {
        start: [start, end],
        connect: true,
        range: {
            'min': min,
            'max': max
        },
        //tooltips: true,
        format: wNumb({
            prefix: prefix,
            decimals: 3,
            thousand: '.',
        })
    });

    slider2.noUiSlider.on('update', function (values, handle,unencoded) {
        inputs[handle].value = values[handle];
    });

    slider2.noUiSlider.on('change', function (values, handle,unencoded) {
        var min = parseInt(unencoded[0]);
        var max = parseInt(unencoded[1]);
        changeF(min,max);
    });
    // Listen to keydown events on the input field.
    inputs.forEach(function (input, handle) {

        input.addEventListener('change', function () {
            slider2.noUiSlider.setHandle(handle, this.value);
            var unencoded = slider2.noUiSlider.get('unencoded');
            var min = parseInt(unencoded[0]);
            var max = parseInt(unencoded[1]);
            changeF(min,max);
        });

        input.addEventListener('keyup', function (e) {

            var values = slider2.noUiSlider.get();
            var value = Number(values[handle]);

            // [[handle0_down, handle0_up], [handle1_down, handle1_up]]
            var steps = slider2.noUiSlider.steps();

            // [down, up]
            var step = steps[handle];

            var position;

            // 13 is enter,
            // 38 is key up,
            // 40 is key down.
            switch (e.which) {
                case 13:
                    slider2.noUiSlider.setHandle(handle, this.value);
                    break;
                case 38:
                    // Get step to go increase slider value (up)
                    position = step[1];
                    // false = no step is set
                    if (position === false) {
                        position = 1;
                    }
                    // null = edge of slider
                    if (position !== null) {
                        slider2.noUiSlider.setHandle(handle, value + position);
                    }
                    break;
                case 40:
                    position = step[0];
                    if (position === false) {
                        position = 1;
                    }
                    if (position !== null) {
                        slider2.noUiSlider.setHandle(handle, value - position);
                    }
                    break;
            }

        });
    });
}
function CountdownProm(elm) {
    var timerdate = elm.data('date'); 

    elm.countdown(timerdate, function (event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"));
    });
}

function initialViewDetaiProduct(par_elm) {
    $.each(par_elm.find('.view-detail-product'), function(index, val) {
        var type = $(val).data('type');
        if(type == 'builds' || type == 'groups'){
            runSlick2(val);
        }else if(type == 'default'){
            var images = $(val).data('images');
            images = images.split(',');
            var html = '<div class="wrap-slick3 flex-sb flex-w">'+
                            '<div class="wrap-slick3-dots">';
                            $.each(images, function(index, image) {
                                html += '<div><img class="w-100" src='+image+' alt="IMG-PRODUCT"><div class="slick3-dot-overlay"></div></div>';
                            });
                    html += '</div>'+
                            '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>'+
                            '<div class="slick3 gallery-lb">';
            $.each(images, function(index, image) {
                html += '<div class="item-slick3">'+
                            '<div class="wrap-pic-w pos-relative">'+
                                '<img src="'+image+'" alt="IMG-PRODUCT">'+
                                '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+image+'">'+
                                    '<i class="fa fa-expand"></i>'+
                                '</a>'+
                            '</div>'+
                        '</div>';
            });
            html += '</div>'+
                    '</div>';

            //html += '<div class="dot_image"><div class="wrap-slick3-arrows flex-sb-m flex-w"></div>'+dot_image+'</div>';
            $(val).html(html);
            runSlick3(val);
        }else{
            $(val).addClass('cloudimage-360');
            window.CI360.init();
        }
    });
}
function ChangeAttibutes($this,type) {
    var target = $($this).find("option:selected");
    var images = target.data("images");
    var attr = $($this).val().split('__')[0];
    var price = $($this).val().split('__')[1];
    var name_att = $($this).parents('.attributes').attr('name');
    if ($($this).parents('.view_detail_product').length) {
        var par_elm = $('.view_detail_product');
    }else{
        var par_elm = $('.quick_view_detail_product');
    }
    var clr_html = '';
    var siz_html = '';
    var html = ' ( '+name_att+': '+attr+' + '+price+' ) ';
    if ($('.clr-pri').length) {
        clr_html = $('.clr_html').html();
    }
    if ($('.siz-pri').length) {
        siz_html = $('.siz_html').html();
    }
    if(type.toLowerCase() == 'color'){
        if (price > 0) {
            clr_html = html;
        }else{
            clr_html = '';
        }
    }
    if(type.toLowerCase() == 'size'){
        if (price > 0) {
            siz_html = html;
        }else{
            siz_html = '';
        }
    }
    par_elm.find('.clr-pri').html(clr_html);
    par_elm.find('.siz-pri').html(siz_html);
    
    if (type.toLowerCase() != 'size') {
        // process change image color
        var type = target.data('type');
        par_elm.find('.view-detail-product').removeClass('cloudimage-360').removeClass('initialized');
        par_elm.find('.view-detail-product').attr('data-type',type);
        if (type == 'threesixty') {    
            par_elm.find('.view-detail-product').html('');
            par_elm.find('.view-detail-product').attr('data-filename',target.data('name')+'-{index}.'+target.data('ext'));
            par_elm.find('.view-detail-product').attr('data-folder',target.data('path'));
            par_elm.find('.view-detail-product').attr('data-amount',target.data('amount'));
            par_elm.find('.view-detail-product').attr('data-autoplay',true);        
            par_elm.find('.view-detail-product').attr('data-full-screen',true);    
            par_elm.find('.view-detail-product').attr('data-magnifier',3);  
            par_elm.find('.view-detail-product').attr('data-lazyload',true);
            par_elm.find('.view-detail-product').attr('data-spin-reverse',true);
      
            par_elm.find('.view-detail-product').addClass('cloudimage-360'); 
            window.CI360.init();
        }else{
            if (!images) {
                if (images == false) {
                    return false;
                }
                images = par_elm.find('.view-detail-product').data('images');
            }
            images = images.split(',');
            var html = '<div class="wrap-slick3 flex-sb flex-w">'+
                            '<div class="wrap-slick3-dots">';
                            $.each(images, function(index, image) {
                                html += '<div><img class="w-100" src="'+image+'" alt="IMG-PRODUCT"><div class="slick3-dot-overlay"></div></div>';
                            });
                    html += '</div>'+
                            '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>'+
                            '<div class="slick3 gallery-lb">';
            $.each(images, function(index, image) {
                html += '<div class="item-slick3">'+
                            '<div class="wrap-pic-w pos-relative">'+
                                '<img src="'+image+'" alt="IMG-PRODUCT">'+
                                '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+image+'">'+
                                    '<i class="fa fa-expand"></i>'+
                                '</a>'+
                            '</div>'+
                        '</div>';
            });
            html += '</div>'+
                    '</div>';
            par_elm.find('.view-detail-product').html(html);
            runSlick3(par_elm);
        }
    }
}