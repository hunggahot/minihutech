{{-- file chứa các dữ liệu được đẩy lên trang chủ --}}

@extends('index')

@section('slider')
    @include('pages.include.slider');
@endsection

@section('sidebar')
    @include('pages.include.sidebar')
@endsection

@section('content')

<div class="features_items"><!--features_items-->
    <div class="fb-share-button" data-href="http://localhost/shopbanhanglaravel" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$meta_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <div class="fb-like" data-href="{{$meta_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
    @foreach($category_name as $key => $name)
    <h2 class="title text-center">{{$name->category_name}}</h2>
    @endforeach

    <div class="row">
        <div class="col-md-4">
            <label for="amount">Sắp xếp theo</label>
            <form action="">
                @csrf
                <select name="sort" id="sort" class="form-control">
                    <option value="{{Request::url()}}?sort_by=none">--Lọc theo--</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
                    <option value="{{Request::url()}}?sort_by=kytu_az">--A đến Z--</option>
                    <option value="{{Request::url()}}?sort_by=kytu_za">--Z đến A--</option>
                </select>
            </form>
        </div>
    </div>

    @foreach($category_by_id as $key => $product)
    <a href="{{URL::to('/product-details/'.$product->product_slug)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                    <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                    <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                    <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                    <a href="{{URL::to('/product-details/'.$product->product_slug)}}">
                        <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                        <h2>{{number_format($product->product_price,0,',','.')}}<sup>đ</sup></h2>
                        <p>{{$product->product_name}}</p>

                     
                     </a>
                    <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart">
                    </form>

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
    </a>
    @endforeach
</div><!--features_items-->
<div class="fb-comments" data-href="{{$meta_canonical}}" data-width="" data-numposts="20"></div>
<div class="fb-page" data-href="https://www.facebook.com/discordcursedimage/" data-tabs="message" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/discordcursedimage/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/discordcursedimage/">𝘿𝙞𝙨𝙘𝙤𝙧𝙙 𝙋𝙤𝙨𝙩𝙞𝙣𝙜</a></blockquote></div>
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!!$category_by_id->links()!!}
 </ul>
@endsection