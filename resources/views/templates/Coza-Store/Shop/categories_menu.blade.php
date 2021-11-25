@php
$categoriesTop = $modelCategory->start()->getCategoryTop()->getData();
@endphp
@if ($categoriesTop->count())
<div class="row vh-100 overflow-auto hide-scr-bar">
    <div class="col-md-12">
		<div class="col-lg-10 m-auto">
		    @foreach ($categoriesTop as $category)
		    <a class="link-tag" href="{{ $category->getUrl() }}">
			    <div class="card card-blog card-background" data-animation="true">
			      <div class="full-background my-cus-bgr" style="background-image: url({{ asset($category->image) }})"></div>
			      <div class="card-body">
			        <div class="content-bottom">
		            	<h3 class="card-title">{{ $category->title }}</h3>
			        </div>
			      </div>
			    </div> 
			</a>
		    @endforeach
		</div>
	</div>
</div>
@endif