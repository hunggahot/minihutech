@extends('index')
@section('content')

@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->

    <style type="text/css">
        .lSSlideOuter .lSPager.lSGallery img{
            display: block;
            height: 80px;
            max-width: 100%;
        }

        li.active{
            border: 2px solid #7FCCFA;
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="{{url('/category-product/'.$cate_slug)}}">{{$product_cate}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
        </ol>
      </nav>

    <div class="col-sm-5">
        <ul id="imageGallery">
            @foreach($gallery as $key => $gal)
            <li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
              <img width="100%" alt="{{$gal->gallery_image}}" src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$value->product_name}}</h2>
            <p>Mã sản phẩm: {{$value->product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_quantity}}" class="cart_product_quantity_{{$value->product_id}}">
                <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                        
            <span>
                <span>{{number_format($value->product_price,0,',','.')}}<sup>đ</sup></span>
            
                <label>Số lượng: </label>
                <input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}"  value="1" />
                <input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
            </span>
            <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" data-id_product="{{$value->product_id}}" name="add-to-cart">
            </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Điều kiện:</b> Mới</p>
            <p><b>Danh Mục:</b> {{$value->category_name}}</p>
            <p><b>Thương Hiệu:</b> {{$value->brand_name}}</p>
            <style type="text/css">
                a.tags_style {
                    margin: 3px 2px;
                    border: 1px solid;
                    border-radius: 5px;
                    height: auto;
                    background: #428bca;
                    color: #ffff;
                    padding: 3px;
                }
                a.tags_style:hover {
                    background: black;
                }
            </style>
            <fieldset>
                <legend>Tags</legend>
                <p><i class="fa fa-tag"></i>
                @php
                    $tags = $value->product_tags;
                    $tags = explode(",", $tags);
                @endphp
                    @foreach($tags as $tag)
                        <a href="{{url('/tag/'.str_slug($tag))}}" class="tags_style">{{$tag}}</a>
                    @endforeach
                </p>
            </fieldset>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li > <a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
            {{-- <li><a href="#tag" data-toggle="tab">Tag</a></li> --}}
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details" >
            <p>{!!$value->product_des!!}</p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <p>{!!$value->product_content!!}</p>
        </div>
        
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <style type="text/css">
                    .style_comment{
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: #f0f0e9;
                    }
                </style>
                <form action="">
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
                    <div id="comment_show"></div>
                    
                    <p></p>
                </form>
                
                <p><b>Viết đánh giá của bạn</b></p>
                {{-- rating --}}
                <ul class="list-inline rating" title="Average Rating">
                    @for($count=1; $count<=5; $count++)
                        @php
                            if($count<=$rating){
                                $color = 'color: #ffcc00;';
                            } else{
                                $color = 'color: #ccc;';
                            }
                        @endphp
                    <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size: 30px;">&#9733;</li>
                    @endfor
                </ul>
                <form action="#">
                    <div id="notify_comment"></div>
                    <span>
                        <input style="width:100%; margin-left:0" type="text" class="comment_name" placeholder="Tên bình luận"/>
                    </span>
                    <textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
                    <b>Đánh giá: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right send-comment">
                        Gửi bình luận
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach

<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm gợi ý</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($related as $key => $relate)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/uploads/product/'.$relate->product_image)}}" alt="" />
                                <h2>{{number_format($relate->product_price)}}<sup>đ</sup></h2>
                                <p>{{$relate->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!!$related->links()!!}
   </ul>

@endsection