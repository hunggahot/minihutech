@extends('index')
@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm cho từ khóa </h2>
    @foreach($search_product as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <a href="{{URL::to('/product_details/'.$product->product_slug)}}"></a>
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                        <a href="{{URL::to('/product-details/'.$product->product_slug)}}">
                        <h2>{{number_format($product->product_price)}}<sup>đ</sup></h2>
                        <p>{{$product->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh sản phẩm</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div><!--features_items-->

@endsection