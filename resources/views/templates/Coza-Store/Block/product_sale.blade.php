@php
	$products = bc_product_flash(bc_config('product_list'));
@endphp
@if (!empty($products))
<section class="categories">
    <div class="slick-ver container">
	    @foreach ($products as $product)
	        <div class="row sale_product_grid">
	        	<div class="dis-flex">
		            <div class="col-lg-3">
		                <div class="categories__text">
		                    @foreach($product->categories as $key => $category)
	                    		@if(($key + 1) == $product->categories->count())
				                    <h2>
				                    	<a href="{{$category->getUrl()}}">
				                    		<span class="p-l-40">{{ $category->getTitle() }}</span>
					                    </a>
					                </h2>
		                    	@else
		                    		<h2 class="p-l-20">
		                    			{{ $category->getTitle() }}
		                    		</h2>
	                    		@endif
		                    @endforeach
		                </div>
		            </div>
		            <div class="col-lg-5">
		                <div class="categories__hot__deal">
		                	@php		                	
	                			// $images = explode(',', $product->getFirstAttributeImage()->images);
		                		$pop_data = '';
		                		if($product->img->type_show == 'threesixty'){
			                		$images = explode(',', $product->img->image);
			                		$image_data = bc_get_threesixty_image($images,460,425);
		                			$pop_data = 'data-autoplay
												data-filename='.$image_data['file_name'].'-{index}.'.$image_data['extension'].'
												data-folder='.$image_data['path'].'/
												data-amount='.count($images).'
												data-lazyload="true"
												data-spin-reverse="true"';
		                		}else{
		                			$pop_data = 'data-images='.$product->img->image.'';
		                		};
		                	@endphp
					        <div class="view-detail-product" data-type="{{$product->img->type_show}}" {{ $pop_data }}></div>
		                    <div class="hot__deal__sticker">
		                        <span>Sale Of</span>
		                        <h5>{{bc_currency_render($product->promotionPrice->price_promotion)}}</h5>
		                    </div>
		                </div>
		            </div>
		            <div class="col-lg-4 info-prod">
		                <div class="categories__deal__countdown">
		                	<h2 title="{{ $product->getName() }}">{{\Illuminate\Support\Str::limit($product->getName(), 20, ' ...')}}</h2>
		                    <span>Deal Of The Week</span>
		                    <div class="categories__deal__countdown__timer countdown" data-date="{{ date('m/d/Y',strtotime($product->promotionPrice->date_end)) }}">
		                    	
	                    	</div>
			                    <a href="{{ $product->getUrl() }}" target="_blank" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" tabindex="-1">
		                            Shop Now
		                        </a>
		                </div>
		            </div>
	        	</div>
	        </div>
	    @endforeach
    </div>
</section>
@endif
<style type="text/css">
	.categories {
		background: #ffffff;
		overflow: hidden;
	}

	.categories__text {
		position: relative;
		height: 100%;
		z-index: 1;
	}

	.categories__text:before {
		position: absolute;
		left: 0;
		top: 0;
		height: 100%;
		width: calc(100% - 94px);
		background: #f3f2ee;
		z-index: -1;
		content: "";
		transform: skew(30deg);
	}

	.categories__text h2 {
		color: #b7b7b7;
		line-height: 72px;
		font-size: 34px;
	}

	.categories__text h2 span {
		font-weight: 700;
		color: #111111;
	}

	.categories__hot__deal {
		
	}

	.hot__deal__sticker {
		height: 100px;
		width: 100px;
		background: #111111;
		border-radius: 50%;
		padding-top: 22px;
		text-align: center;
		position: absolute;
		right: 0;
		top: 0;
	}

	.hot__deal__sticker span {
		display: block;
		font-size: 15px;
		color: #ffffff;
		margin-bottom: 4px;
	}

	.hot__deal__sticker h5 {
		color: #ffffff;
		font-size: 20px;
		font-weight: 700;
	}
	.categories__deal__countdown span {
		color: #e53637;
		font-size: 14px;
		font-weight: 700;
		text-transform: uppercase;
		letter-spacing: 2px;
		margin-bottom: 15px;
		display: block;
	}

	.categories__deal__countdown h2 {
		color: #111111;
		font-weight: 700;
		line-height: 46px;
		margin-bottom: 25px;
	}

	.categories__deal__countdown .categories__deal__countdown__timer {
		overflow: hidden;
		margin-left: -30px;
	}

	.categories__deal__countdown .categories__deal__countdown__timer .cd-item {
		width: 25%;
		float: left;
		margin-bottom: 25px;
		text-align: center;
		position: relative;
	}

	.categories__deal__countdown .categories__deal__countdown__timer .cd-item:after {
		position: absolute;
		right: 0;
		top: 7px;
		content: ":";
		font-size: 24px;
		font-weight: 700;
		color: #3d3d3d;
	}

	.categories__deal__countdown .categories__deal__countdown__timer .cd-item:last-child:after {
		display: none;
	}

	.categories__deal__countdown .categories__deal__countdown__timer .cd-item span {
		color: #111111;
		font-weight: 700;
		display: block;
		font-size: 36px;
	}

	.categories__deal__countdown .categories__deal__countdown__timer .cd-item p {
		margin-bottom: 0;
	}
	.sale_product_grid{
		/*padding:50px 0;*/
	}
	.slick-dots{
		display: flex;
		justify-content: center;
		padding: 5px;
	}
	.slick-dots li{
		background: #717fe0;
		margin:0px 5px;
		color: #fff;
		border-radius: 7px;
		padding: 5px 10px;
	}
	.slick-dots li button{
		color: #fff;
	}
	.slick-list{
		height: unset!important;
	}
</style>
@push('scripts')
<script type="text/javascript" src="{{ bc_public_path_flash('/js/jquery.countdown.min.js') }}"></script>
<script type="text/javascript">
	$.each($('.countdown'), function(index, val) {
		CountdownProm($(val));
	});
	SlickVertical('.slick-ver');
	initialViewDetaiProduct($('.sale_product_grid'))
</script>
@endpush