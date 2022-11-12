@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê thương hiệu sản phẩm
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
              <th>Tên thương hiệu</th>
              <th>Tên slug thương hiệu</th>
              <th>Trạng thái thương hiệu</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($all_brand_product as $key => $brand_pro)
            <tr>
              @php
                  $i++;
              @endphp
              <td><i>{{$i}}</i></td>
              <td>{{ $brand_pro -> brand_name }}</td>
              <td>{{ $brand_pro -> brand_slug }}</td>
              <td><span class="text-ellipsis">
                <?php
                    if($brand_pro -> brand_status == 0){
                ?>
                   <a href="{{URL::to('/unactive-brand-product/'.$brand_pro -> brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                    <a href="{{URL::to('/active-brand-product/' .$brand_pro -> brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
                </span></td>
              <td>
                <a href="{{URL::to('/edit-brand-product/'.$brand_pro -> brand_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-brand-product/'.$brand_pro -> brand_id)}}" class="active styling-delete" ui-toggle-class="">
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
                        {!!$all_brand_product->links()!!}
                    </ul>
                </div>
            </div>
        </div> 
      </footer> --}}
    </div>
  </div>
</div>
@endsection