@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật bài viết
                </header>
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">' ,$message. '</span>';
                        Session::put('message', null);
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post"  enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" value="{{$post->post_title}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên slug bài viết</label>
                            <input type="text" name="post_slug" value="{{$post->post_slug}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea style="resize: none;" rows="8" value="" name="post_sum" class="form-control" id="ckeditor2" placeholder="Mô tả danh mục">{{$post->post_sum}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize: none;" rows="8" value="" name="post_content" class="form-control" id="ckeditor3" placeholder="Mô tả danh mục">{{$post->post_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta từ khóa bài viết</label>
                            <textarea style="resize: none;" value="" rows="5" name="post_meta_keywords" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$post->post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta nội dung</label>
                            <textarea style="resize: none;" rows="5" value="" name="post_meta_des" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$post->post_meta_des}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục bài viết</label>
                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                @foreach($cate_post as $key => $cate)
                                <option {{$post->cate_post_id == $cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="post_status" class="form-control input-sm m-bot15">
                                @if($post->post_status == 0)
                                <option selected value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                                @else
                                <option value="0">Hiển thị</option>
                                <option selected value="1">Ẩn</option>
                                @endif
                            </select>
                        </div>
                       
                        <button type="submit" name="update_post" class="btn btn-info">Cập nhật bài viết</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>

@endsection