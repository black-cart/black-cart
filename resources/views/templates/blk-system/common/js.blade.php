<script type="text/javascript">
  function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
  }
  $('#shipping').change(function(){
    $('#total').html('<span>'+formatNumber(parseInt({{ Cart::subtotal() }})+ parseInt($('#shipping').val()))+'</span>');
  });
</script>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script>

    function confirmMsg(quest = '',msg = '',link = '') {
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
        if (result.value) {
            window.location.href = link;
        }
      });
      return false;
    }

    function showNotification(type, message) {
      console.log(type);
      $.notify({
        icon: "tim-icons icon-bell-55",
        message: message

      }, {
        type: type,
        timer: 8000,
        placement: {
          from: 'top',
          align: 'right'
        },
        offset:{
          x: 50,
          y: 80
        }
      });
    }
</script>

<!--process cart-->
<script type="text/javascript">
  function addToCartAjax(id, instance = null, storeId = null){
    $.ajax({
        url: "{{ sc_route('cart.add_ajax') }}",
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
          // console.log(data);
            error = parseInt(data.error);
            if(error ==0)
            {
              setTimeout(function () {
                if(data.instance =='default'){
                  $('.cart_item').html(data.count_cart);
                }else{
                  $('.cart_item_'+data.instance).html(data.count_cart);
                }
              }, 1000);
              showNotification('success', data.msg);
            }else{
              if(data.redirect){
                window.location.replace(data.redirect);
                return;
              }
              showNotification('danger', data.msg);
            }

        }
    });
  }
</script>
<!--//end cart -->

<!--login-->
<script type="text/javascript">
  function LoginAjax(elm){
    var form = $(elm).parents('.login-form');
    var email = form.find('[name="email"]').val();
    var password = form.find('[name="password"]').val();
    $.ajax({
        url: "{{ sc_route('postLogin') }}",
        type: "POST",
        dataType: "JSON",
        data: {
          "email":email,
          "password":password,
          "_token":"{{ csrf_token() }}"
        },
        async: false,
        success: function(data){
          console.log(data);
            

        }
    });
  }
</script>
<!--//end login -->


<!--message-->
@if(Session::has('success'))
<script type="text/javascript">
    showNotification('success', '{!! Session::get('success') !!}');
</script>
@endif

@if(Session::has('error'))
<script type="text/javascript">
  showNotification('danger', '{!! Session::get('error') !!}');
</script>
@endif

@if(Session::has('warning'))
<script type="text/javascript">
  showNotification('danger', '{!! Session::get('warning') !!}');
</script>
@endif
<!--//message-->
