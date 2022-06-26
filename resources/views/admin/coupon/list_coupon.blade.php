@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê mã giảm giá
      </div>
      
      <p><a href="{{url('/send-coupon-vip')}}" class="btn btn-default">Gửi mã giảm giá cho khách vip</a></p>
      <p><a href="{{url('/send-coupon')}}" class="btn btn-default">Gửi mã giảm giá cho khách thường</a></p>
      
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
              
              <th>Tên mã giảm giá</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Mã giảm giá</th>
              <th>Số lượng mã</th>
              <th>Điều kiện giảm giá</th>
              <th>Số giảm</th>
              <th>Tình trạng</th>
              <th>Hết hạn</th>
              <th></th>
              
            </tr>
          </thead>
          <tbody>
            @foreach($coupon as $key => $cou)
            <tr>
              
              <td>{{ $cou->coupon_name }}</td>
              <td>{{ $cou->coupon_date_start }}</td>
              <td>{{ $cou->coupon_date_end }}</td>
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
              <span class="text-ellipsis">
              <?php
                  if($cou->coupon_status == 1){
              ?>
                <span style="color: green">Đang kích hoạt</span> 
              <?php
              }else{
              ?>
                  <span style="color: red">Đã khóa</span> 
              <?php
              }
              ?>
              </span>
           </td>
           <td>
                @if($cou->coupon_date_end>$today)
                  <span style="color: green">Còn hạn</span>
                @else
                  <span style="color: red">Hết Hạn</span>
                @endif
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