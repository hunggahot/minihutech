@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê sản phẩm
      </div>
      <div class="table-responsive">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">' ,$message. '</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Slug sản phẩm</th>
              <th>Số lượng</th>
              <th>Giá sản phẩm</th>
              <th>Hình ảnh sản phẩm</th>
              <th>Thư viện ảnh sản phẩm</th>
              <th>Danh Mục sản phẩm</th>
              <th>Thương hiệu sản phẩm</th>
              <th>Size sản phẩm</th>
              <th>Trạng thái sản phẩm</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($all_product as $key => $pro)
            @php
                $i++;
            @endphp
            <tr>
              <td><i>{{$i}}</i></td>
              <td>{{ $pro -> product_name }}</td>
              <td>{{ $pro -> product_slug }}</td>
              <td>{{ $pro -> product_quantity }}</td>
              <td>{{ $pro -> product_price }}</td>
              <td><img src="public/uploads/product/{{ $pro -> product_image }}" height="100" width="100" alt=""></td>
              <td><a href="{{('add-gallery/'.$pro->product_id)}}">Thêm thư viện ảnh</a></td>
              <td>{{ $pro -> category_name }}</td>
              <td>{{ $pro -> brand_name }}</td>
              <td>{{ $pro -> size_number }}</td>
              <td><span class="text-ellipsis">
                <?php
                    if($pro -> product_status == 0){
                ?>
                   <a href="{{URL::to('/unactive-product/'.$pro -> product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                    <a href="{{URL::to('/active-product/' .$pro -> product_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
                </span></td>
              <td>
                <a href="{{URL::to('/edit-product/'.$pro -> product_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-product/'.$pro -> product_id)}}" class="active styling-delete" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
            <div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$all_product->links()!!}
                    </ul>
                </div>
            </div>
        </div> 
      </footer> --}}
    </div>
  </div>
@endsection