<div class="row isotope-grid">
	@foreach ($products as $key => $product)
		<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item @foreach($product->categories as $category) {{$category->id}} @endforeach">
		  	@include($bc_templatePath.'.Common.product',['product' => $product])
		</div>
	@endforeach
</div>
<!-- paginate -->
{{ $products->appends(request()->except(['page','_token']))->links() }}
