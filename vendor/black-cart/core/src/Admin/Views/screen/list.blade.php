@extends($templatePathAdmin.'Layout.main')

@section('main')
<div class="row">
@if (!empty($topMenuLeft) && count($topMenuLeft))
  <div class="col-md-{{ !empty($topMenuRight) ? 6 : 12 }}">
    <div class="card" >
      <div class="card-body" >
        @if (!empty($topMenuLeft) && count($topMenuLeft))
          @foreach ($topMenuLeft as $item)
              @php
              $arrCheck = explode('view::', $item);
              @endphp
              @if (count($arrCheck) == 2)
                @if (view()->exists($arrCheck[1]))
                  @include($arrCheck[1])
                @endif
              @else
                {!! trim($item) !!}
              @endif
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endif
@if (!empty($topMenuRight) && count($topMenuRight))
  <div class="col-md-{{ !empty($topMenuLeft) ? 6 : 12 }}">
    <div class="card" >
      <div class="card-body" >
          @foreach ($topMenuRight as $item)
              @php
                $arrCheck = explode('view::', $item);
              @endphp
              @if (count($arrCheck) == 2)
                @if (view()->exists($arrCheck[1]))
                  @include($arrCheck[1])
                @endif
              @else
                {!! trim($item) !!}
              @endif
          @endforeach
      </div>
    </div>
  </div>
@endif
  <div class="col-md-12">
    <div class="card" >
      <div class="card-header">
        <div class="row">
          <div class="col-md-6 align-items-center d-flex">
            <div class="btn-group">
              @if (!empty($removeList))
                <button type="button" class="btn btn-info grid-select-all"><i class="fas fa-square"></i></button>
                <button type="button" class="btn btn-info grid-trash" title="{{ trans('admin.delete') }}"><i class="fas fa-trash-alt"></i></button>
              @endif
              @if (!empty($buttonRefresh))
              <button type="button" class="btn btn-info grid-refresh" title="{{ trans('admin.refresh') }}"><i class="fas fa-sync-alt"></i></button>
              @endif
            </div>
            @if (!empty($buttonSort))
              <div class="col-md-6">
                <div class="form-group mb-0">
                  <select class="selectpicker mb-0" data-style="btn btn-primary" title="Single Select" tabindex="-98" id="order_sort">
                    <option disabled="" selected="">Order By</option>
                    {!! $optionSort??'' !!}
                  </select>
                </div>
              </div>
            @endif
          </div>
          <div class="col-md-6 text-right">
            @if (!empty($menuLeft) && count($menuLeft))
              @foreach ($menuLeft as $item)
                    @php
                        $arrCheck = explode('view::', $item);
                    @endphp
                    @if (count($arrCheck) == 2)
                      @if (view()->exists($arrCheck[1]))
                        @include($arrCheck[1])
                      @endif
                    @else
                      {!! trim($item) !!}
                    @endif
              @endforeach
            @endif
            @if (!empty($menuRight) && count($menuRight))
               @foreach ($menuRight as $item)
                    @php
                        $arrCheck = explode('view::', $item);
                    @endphp
                    @if (count($arrCheck) == 2)
                      @if (view()->exists($arrCheck[1]))
                        @include($arrCheck[1])
                      @endif
                    @else
                      {!! trim($item) !!}
                    @endif
               @endforeach
              @endif
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0" id="pjax-container">
        @php
            $urlSort = $urlSort ?? '';
        @endphp
        <div id="url-sort" data-urlsort="{!! strpos($urlSort, "?")?$urlSort."&":$urlSort."?" !!}"  style="display: none;"></div>
        <div class="table-responsive">
        <table class="table table-hover box-body text-wrap table-bordered">
          <thead>
            <tr>
              @if (!empty($removeList))
              <th></th>
              @endif
              @foreach ($listTh as $key => $th)
                <th>{!! $th !!}</th>
              @endforeach
             </tr>
          </thead>
          <tbody>
            @foreach ($dataTr as $keyRow => $tr)
            <tr>
                @if (!empty($removeList))
                <td>
                  <div class="form-check pull-left">
                    <label class="form-check-label">
                      <input class="form-check-input grid-row-checkbox" type="checkbox" data-id="{{ $tr['id']??'' }}">
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                </td>
                @endif
                @foreach ($tr as $key => $trtd)
                    <td>{!! $trtd !!}</td>
                @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        
        <div class="block-pagination clearfix m-10">
          <div class="ml-3 float-left">
            {!! $resultItems??'' !!}
          </div>
          <div class="pagination pagination-sm mr-3 float-right">
            {!! $pagination??'' !!}
          </div>
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer clearfix">
        @if (!empty($blockBottom) && count($blockBottom))
        @foreach ($blockBottom as $item)
          <div class="clearfix">
            @php
            $arrCheck = explode('view::', $item);
            @endphp
            @if (count($arrCheck) == 2)
              @if (view()->exists($arrCheck[1]))
                @include($arrCheck[1])
              @endif
            @else
              {!! trim($item) !!}
            @endif
          </div>    
        @endforeach
      @endif
      </div>


    </div>
    <!-- /.card -->
  </div>
</div>
@endsection


@push('css')
<style type="text/css">
  .btn.dropdown-toggle[data-toggle=dropdown]{
    margin-bottom: 0px;
  }
  .pagination .page-item .page-link{
    line-height: 25px;
  }
</style>
{!! $css ?? '' !!}
@endpush

@push('scripts')
    {{-- //Pjax --}}
    <script src="{{ asset('admin/black/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('admin/black/js/plugins/bootstrap-datetimepicker.js') }}"></script>
   <script src="{{ asset('admin/plugin/jquery.pjax.js')}}"></script>

  <script type="text/javascript">

    blackDashboard.initDateTimePicker();
  
    $('.grid-refresh').click(function(){
      $.pjax.reload({container:'#pjax-container'});
    });

      $(document).on('submit', '#button_search', function(event) {
        $.pjax.submit(event, '#pjax-container')
      })

    $(document).on('pjax:send', function() {
      $('#loading').show()
    })
    $(document).on('pjax:complete', function() {
      $('#loading').hide()
    })

    // tag a
    $(function(){
     $(document).pjax('a.page-link', '#pjax-container')
    })


    $(document).ready(function(){
    // does current browser support PJAX
      if ($.support.pjax) {
        $.pjax.defaults.timeout = 2000; // time in milliseconds
      }
    });

    @if ($buttonSort)
      $('#button_sort').click(function(event) {
        var url = $('#url-sort').data('urlsort')+'sort_order='+$('#order_sort option:selected').val();
        $.pjax({url: url, container: '#pjax-container'})
      });
    @endif

  </script>
    {{-- //End pjax --}}


<script type="text/javascript">
{{-- sweetalert2 --}}
var selectedRows = function () {
    var selected = [];
    $('.grid-row-checkbox:checked').each(function(){
        selected.push($(this).data('id'));
    });

    return selected;
}

$('.grid-trash').on('click', function() {
  var ids = selectedRows().join();
  deleteItem(ids);
});
  
function deleteItem(ids){
  swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true,
  }).fire({
    title: '{{ trans('admin.confirm_delete') }}',
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: '{{ trans('admin.confirm_delete_yes') }}',
    confirmButtonColor: "#DD6B55",
    cancelButtonText: '{{ trans('admin.confirm_delete_no') }}',
    reverseButtons: true,
    preConfirm: function() {
        return new Promise(function(resolve) {
            $.ajax({
                method: 'post',
                url: '{{ $urlDeleteItem ?? '' }}',
                data: {
                  ids:ids,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    if(data.error == 1){
                      alertMsg('danger', data.msg, '{{ trans('admin.warning') }}');
                      $.pjax.reload('#pjax-container');
                      return;
                    }else{
                      alertMsg('success', data.msg);
                      $.pjax.reload('#pjax-container');
                      resolve(data);
                    }

                }
            });
        });
    }

  }).then((result) => {
    if (result.value) {
      alertMsg('success', '{{ trans('admin.confirm_delete_deleted_msg') }}', '{{ trans('admin.confirm_delete_deleted') }}');
    }
  })
}
</script>

{!! $js ?? '' !!}
@endpush
