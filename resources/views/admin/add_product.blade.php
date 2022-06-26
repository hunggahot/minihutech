@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
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
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Tên sản phẩm phải có ít nhất 3 ký tự trở lên" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="slug sản phẩm phải có ít nhất 3 ký tự trở lên" name="product_slug" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Vui lòng nhập số lượng sản phẩm" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Số tiền phải là những con số" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none;" rows="8" name="product_des" class="form-control" id="ckeditor1" placeholder="Mô tả sản phẩm"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none;" rows="8" name="product_content" class="form-control" id="ckeditor" placeholder="Mô tả nội dung sản phẩm"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                    @if($cate->category_parent == 0)
                                        <option style="color: red" value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @foreach($cate_product as $key => $cate_sub)
                                            @if($cate_sub->category_parent != 0 && $cate_sub->category_parent == $cate->category_id)
                                                <option style="color: green" value="{{$cate_sub->category_id}}">--{{$cate_sub->category_name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tags sản phẩm</label>
                            <input type="text" name="product_tags" data-role="tagsinput" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                       
                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>

@endsection