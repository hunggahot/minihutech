{{-- file chứa các dữ liệu được đẩy lên trang chủ --}}

@extends('index')
@section('content')

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">{{$meta_title}}</h2>
    
    <div class="product-image-wrapper">
        @foreach($post as $key => $p)
        <div class="single-products" style="margin: 10px 0;">
                <div class="text-center">
                   
                    <img style="float: left; width: 30%; padding: 5px; height: 150px; object-fit:cover" src="{{asset('public/uploads/post/'.$p->post_image)}}" alt="{{$p->post_slug}}"/>
                
                    <h4 style="color: #000; padding: 5px">{{$p->post_title}}</h4>
                    <p>{!!$p->post_meta_des!!}</p>
                </div>

                <div class="text-right">
                    <a href="{{url('/post/'.$p->post_slug)}}" class="btn btn-default btn-sm">Xem bài viết</a>
                </div>
        </div>
        <div class="clearfix"></div>
    </div>
    @endforeach
</div><!--features_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">
    {!!$post->links()!!}
   </ul>

@endsection