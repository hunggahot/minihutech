@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Size
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
                        <form role="form" action="{{URL::to('/insert-size')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số Size</label>
                            <input type="text" name="size_number" class="form-control" id="exampleInputEmail1" placeholder="Số size">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="size_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                       
                        <button type="submit" name="add_size" class="btn btn-info">Thêm Size</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>

@endsection