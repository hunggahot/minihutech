@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê mã giảm giá
      </div>
      
      <p><a href="{{url('/send-coupon')}}" class="btn btn-default">Gửi mã giảm giá cho khách vip</a></p>

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
              
              <th>Tiêu đề giảm giá</th>
              <th>Mã giảm giá</th>
              <th>Số lượng mã</th>
              <th>Trạng thái</th>
              <th>Số giảm</th>
              <th></th>
              
            </tr>
          </thead>
          <tbody>
            @foreach($coupon as $key => $cou)
            <tr>
              
              <td>{{ $cou->coupon_name }}</td>
              <td>{{ $cou->coupon_code }}</td>
              <td>{{ $cou->coupon_times }}</td>
              <td>
                <span class="text-ellipsis">
                <?php
                    if($cou->coupon_condition == 1){
                ?>
                   Giảm theo %
                <?php
                }else{
                ?>
                    Giảm theo tiền
                <?php
                }
                ?>
                </span>
             </td>

              <td>
                <span class="text-ellipsis">
                <?php
                    if($cou->coupon_condition == 1){
                ?>
                   Giảm {{$cou->coupon_number}}%
                <?php
                }else{
                ?>
                    Giảm {{$cou->coupon_number}}<sup>đ</sup>
                <?php
                }
                ?>
                </span>
            </td>

              <td>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-delete" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    
    </div>
  </div>
</div>
@endsection