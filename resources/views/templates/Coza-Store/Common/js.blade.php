<script src="{{ asset($bc_templateFile)}}/vendor/sweetalert/sweetalert.min.js"></script>
<script src="{{ asset($bc_templateFile)}}/vendor/bootstrap/js/bootstrap-notify.js"></script>
<script>
  $(".submit").click(function(event) {
    var txt = $(this).text();
    var $this = $(this);
    $this.attr('disabled');
    $this.html("<i class='fa fa-spinner fa-spin'></i>");
    setTimeout(function (argument) {
      $this.html(txt);
      $this.attr('disabled',false);
    },1000)
  });
  function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
  }
  $('#shipping').change(function(){
    $('#total').html('<span>'+formatNumber(parseInt({{ Cart::subtotal() }})+ parseInt($('#shipping').val()))+'</span>');
  });
  function confirmMsg(quest = '',msg = '',link = '',callback) {
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-info btn-round',
        cancelButton: 'btn btn-danger btn-round'
      },
      buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
      title: quest,
      text: msg,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed && link != '') {
          window.location.href = link;
      }
      else if(callback != null){
        callback(result && result.isConfirmed == true);
      }
    });
    return false;
  }
  /*[ +/- num product ]*/
  $('body').on('click','.btn-num-product-down', function(){
      var numProduct = Number($(this).next().val());
      if(numProduct > 0) $(this).next().val(numProduct - 1);
  });

  $('body').on('click','.btn-num-product-up',function(){
      var numProduct = Number($(this).prev().val());
      $(this).prev().val(numProduct + 1);
  });
  $('body').on('click','.js-addcart-detail',function(event) {
    var flag = true;
    $('.attributes').each(function(index, val) {
      var name = $(val).attr('name');
      var value = $(val).find('.'+name+'__').val();
      if(value == '0'){
        $(val).addClass('error-bor');
        flag = false;
      }else{        
        $(val).removeClass('error-bor');
      }
    });
    if(flag){        
      $(this).parents('form').submit();
    }
  });
  function showNotification(type, message) {
    $.notify({
      icon: "zmdi zmdi-notifications-active",
      message: message
    }, {
      type: type,
      allow_dismiss: true,
      timer: false,
      placement: {
        from: 'top',
        align: 'right'
      },
      z_index:9999,
      offset:{
        x: 50,
        y: 80
      }
    });
  }
// quick view product
  $('body').on('click','.js-show-modal1',function(event) {
    var id = $(this).data('id');
    var storeId = $(this).data('storeid');
    $.ajax({
        url: "{{ bc_route('product.quickview') }}",
        type: "POST",
        data: {
          "id":id,
          "storeId":storeId,
          "_token":"{{ csrf_token() }}"
        },
        async: true,
        success: function(data){
          var elm = $('.quick_view_detail_product');
          elm.html(data);
          // reinitial library
          elm.find('.js-select2').each(function(){
              $(this).select2({
                  minimumResultsForSearch: 20,
                  dropdownParent: $(this).next('.dropDownSelect2')
              });
          }) 
          initialViewDetaiProduct(elm)
          // if (type == 'threesixty') {
          //   block_img.addClass('cloudimage-360');
          //   window.CI360.init();   
          // }else{
          //   var images = block_img.data('images');
          //   images = images.split(',');
          //   var html = '<div class="wrap-slick3 flex-sb flex-w">'+
          //                   '<div class="wrap-slick3-dots">';
          //                   $.each(images, function(index, image) {
          //                       html += '<div><img class="w-100" src='+image+' alt="IMG-PRODUCT"><div class="slick3-dot-overlay"></div></div>';
          //                   });
          //           html += '</div>'+
          //                   '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>'+
          //                   '<div class="slick3 gallery-lb">';
          //   $.each(images, function(index, image) {
          //       html += '<div class="item-slick3">'+
          //                   '<div class="wrap-pic-w pos-relative">'+
          //                       '<img src="'+image+'" alt="IMG-PRODUCT">'+
          //                       '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="'+image+'">'+
          //                           '<i class="fa fa-expand"></i>'+
          //                       '</a>'+
          //                   '</div>'+
          //               '</div>';
          //   });
          //   html += '</div>'+
          //           '</div>';
          //   block_img.html(html);
          //   runSlick3($('.quick_view_detail_product'));
          // } 
        }
    });
  });
//process cart-->
  function addToCartAjax($this,id, instance = null, storeId = null){
    var nameProduct = $($this).parents('.block2').find('.js-name-b2').text();
    $.ajax({
        url: "{{ bc_route('cart.add_ajax') }}",
        type: "POST",
        dataType: "JSON",
        data: {
          "id": id,
          "instance":instance,
          "storeId":storeId,
          "_token":"{{ csrf_token() }}"
        },
        async: false,
        success: function(data){
          console.log(data);
            error = parseInt(data.error);
            if(error ==0)
            {             
              $('.cart_item_'+data.instance).attr('data-notify', data.count_cart);
              if(data.instance == 'default'){
                $('.cart_title').removeClass('text-danger').html('{{trans('cart.your_cart')}}');
                $('.carts__content').html(data.html_items);
                $('.cart-total-amount').html(data.subtotal);
                $('.cart-total-item').html(data.count_cart);
              }
              if(data.instance == 'favorite'){
                /// render block to list
                if ($('.heart__'+id).hasClass('zmdi-favorite-outline') === true) {
                  // add
                  $('.heart__'+id).addClass('zmdi-favorite').removeClass('zmdi-favorite-outline');
                  var block = $($this).closest('.block2').clone(true);
                  $('.favorites__content').append('<li class="header-cart-item flex-w flex-t m-b-12 favorite__'+id+'"><div class="block2">'+$(block).html()+'</div></li>');
                  if(data.count_cart == 1){
                    $('.favorites_title').removeClass('text-danger').html('{{trans('front.favoriteslist')}}');
                  }
                }else{
                  // remove
                  if ($('.favorites__content').find('.favorite__'+id).html() != '') {
                    $('.favorites__content').find('.favorite__'+id).remove();
                  }
                  if (data.count_cart == 0) {
                    $('.favorites_title').addClass('text-danger').html('{{trans('front.empty_favorite')}}');
                  }
                  $('.heart__'+id).addClass('zmdi-favorite-outline').removeClass('zmdi-favorite');
                }
              }
              swal.fire(nameProduct, data.msg, "success");
            }else{
              if(data.redirect){
                window.location.replace(data.redirect);
                return;
              }
              swal.fire(nameProduct, data.msg, "error");
            }

        }
    });
  }
//end cart -->

//login-->
  function LoginAjax(elm){
    var form = $(elm).parents('.login-form');
    var email = form.find('.log-email').val();
    var password = form.find('.log-password').val();
    $.ajax({
        url: "{{ bc_route('postLogin') }}",
        type: "POST",
        dataType: "JSON",
        data: {
          "email":email,
          "password":password,
          "_token":"{{ csrf_token() }}"
        },
        async: false,
        success: function(data){
          swal.fire('{{trans('auth.login_success')}}', '' , "success");
          setTimeout(function (argument) {            
              window.location.reload();
          },2000)
        },error: function(jqXhr, json, errorThrown){
          var errors = jqXhr.responseJSON;
          $.each(errors['errors'], function (index, value) {
            $('.err-'+index).html(value[0]);
          });
        }
    });
  }
//end login -->
</script>

@if(Session::has('login_form'))
<script type="text/javascript">
  $('.js-show-modal-login').click();
</script>
@endif

@if(Session::has('register_state'))
<script type="text/javascript">
  $('.js-show-modal-register').click();
</script>
@endif

@if(Session::has('forgot_state'))
<script type="text/javascript">
  $('.js-show-modal-forgot').click();
</script>
@endif

@if(Session::has('reset_state'))
<script type="text/javascript">
  $('.js-show-modal-reset').click();
</script>
@endif

@if(Session::has('reset_success'))
<script type="text/javascript">
    swal.fire('{{ trans('account.update_success') }}', '' , "success");
</script>
@endif

@if(Session::has('reset_failed'))
<script type="text/javascript">
    $('.js-show-modal-reset').click();
</script>
@endif

@if(Session::has('mailed_success'))
<script type="text/javascript">
    swal.fire('{{ trans('account.verify_email.msg_sent') }}', '' , "success");
</script>
@endif

@if(Session::has('mailed_failed'))
<script type="text/javascript">
    swal.fire('{{ trans('account.verify_email.link_invalid') }}', '' , "error");
</script>
@endif

@if(Session::has('register_success'))
<script type="text/javascript">
    swal.fire('{!! Session::get('register_success') !!}', '' , "success");
</script>
@endif

@if(Session::has('order_success'))
<script type="text/javascript">
    swal.fire('{!! Session::get('order_success') !!}', '{!! trans('order.success.msg') !!}' , "success");
</script>
@endif
<!--message-->
@if(Session::has('success'))
<script type="text/javascript">
    swal.fire('{!! Session::get('success') !!}', '' , "success");
</script>
@endif

@if(Session::has('error'))
<script type="text/javascript">
  swal.fire('{!! Session::get('error') !!}', '' , "error");
</script>
@endif

@if(Session::has('warning'))
<script type="text/javascript">
  swal.fire('{!! Session::get('warning') !!}', '' , "error");
</script>
@endif
<!--//message-->
