{{-- file chứa các dữ liệu được đẩy lên trang chủ --}}

@extends('index')
@section('content')

<div class="features_items"><!--features_items-->
    <h2 style="margin: 0; position: inherit; font-size: 22px" class="title text-center">{{$meta_title}}</h2>
    
    <div class="product-image-wrapper">
        @foreach($post as $key => $p)
        <div class="single-products" style="margin: 10px 0;">
                {!!$p->post_content!!}
        </div>
        <div class="clearfix"></div>
    </div>
    @endforeach
</div><!--features_items-->
<h2 style="margin: 0; position: inherit; font-size: 22px" class="title text-center">Bài viết liên quan</h2>
<style type="text/css">
ul.post_relate li {
    list-style-type: disc;
    font-size: 16px;
    padding: 6px
}

ul.post_relate li a{
    color: #000;
}

ul.post_relate li a:hover{
    color: #fe980f;
}

</style>
<ul class="post_relate">
    @foreach($related as $key => $r)
    <li><a href="{{url('/post/'.$r->post_slug)}}">{{$r->post_title}}</a></li>
    @endforeach
</ul>

@endsection