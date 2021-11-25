@php
	$products = $modelProduct->start()->getProductLatest()->setlimit(bc_config('product_top'))->getData();
@endphp
@if (!empty($products))
    @foreach ($products as $product)
    	<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item @foreach($product->categories as $category) {{$category->id}} @endforeach">	
		    @include($bc_templatePath.'.Common.product',['product' => $product])
    	</div>
    @endforeach
@endif
