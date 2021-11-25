@php
$productPromotion = $modelProduct->getProductPromotion()->setRandom()->setLimit(bc_config('product_viewed'))->getData()
@endphp
@if (!empty($productPromotion))
@foreach ($productPromotion as $product)
  @include($bc_templatePath.'.Common.product',['product' => $product])
@endforeach
<!--/product special-->
@endif