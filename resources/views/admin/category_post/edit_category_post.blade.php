@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập danh mục bài viết
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
                        <form role="form" action="{{URL::to('/update-category-post/'.$category_post->cate_post_id)}}" method="post">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="cate_post_name" class="form-control" value="{{$category_post->cate_post_name}}" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục bài viết</label>
                            <input type="text" name="cate_post_slug" class="form-control" value="{{$category_post->cate_post_slug}}" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none;" rows="8" name="cate_post_des" class="form-control" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$category_post->cate_post_des}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="cate_post_status" class="form-control input-sm m-bot15">
                                @if($category_post->cate_post_status == 0)
                                <option selected value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                                @else
                                <option value="0">Hiển thị</option>
                                <option selected value="1">Ẩn</option>
                                @endif
                            </select>
                        </div>
                       
                        <button type="submit" name="update_post_cate" class="btn btn-info">Cập nhật danh mục bài viết</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>

@endsection