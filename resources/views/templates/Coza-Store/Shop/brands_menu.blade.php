@php
$brands = $modelBrand->start()->getData();
@endphp
@if (!empty($brands))
<div class="row vh-100 overflow-auto hide-scr-bar">
    <div class="col-md-12">
		<div class="col-lg-10 m-auto">
		    @foreach ($brands as $brand)
		    <a class="link-tag" href="{{ $brand->getUrl() }}">
			    <div class="card card-blog card-background" data-animation="true">
			      <div class="full-background my-cus-bgr" style="background-image: url({{ asset($brand->image) }})"></div>
			      <div class="card-body">
			        <div class="content-bottom">
		            	<h3 class="card-title">{{ $brand->name }}</h3>
			        </div>
			      </div>
			    </div> 
			</a>
		    @endforeach
		</div>
	</div>
</div>
@endif
