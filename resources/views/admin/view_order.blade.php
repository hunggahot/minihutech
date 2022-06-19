@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin đăng nhập
      </div>
      <div class="table-responsive">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">' ,$message. '</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              
              <th>Tên khách hàng</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              
            </tr>
          </thead>
          <tbody>
            
            <tr>
              <td>{{$customer->customer_name}}</td>
              <td>{{$customer->customer_phone}}</td>
              <td>{{$customer->customer_email}}</td>
              
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin giao hàng
      </div>
      <div class="table-responsive">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">' ,$message. '</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên người giao hàng</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Ghi chú</th>
              <th>Hình thức thanh toán</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$shipping->shipping_name}}</td>
              <td>{{$shipping->shipping_address}}</td>
              <td>{{$shipping->shipping_phone}}</td>
              <td>{{$shipping->shipping_email}}</td>
              <td>{{$shipping->shipping_notes}}</td>
              <td>@if($shipping->shipping_method == 0) Chuyển khoản @else Tiền mặt @endif</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê chi tiết đơn hàng
      </div>
     
      <div class="table-responsive">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">' ,$message. '</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên Sản phẩm</th>
              <th>Mã giảm giá</th>
              <th>Phí giao hàng</th>
              <th>Số lượng</th>
              <th>Giá sản phẩm</th>
              <th>Tổng tiền</th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
                $total = 0;
            @endphp
            @foreach($order_details as $key => $details)
              @php
                  $i++;
                  $subtotal = $details->product_price * $details->product_sales_quantity;
                  $total += $subtotal;
              @endphp
              <tr>
                <td><i>{{$i}}</i></td>
                <td>{{$details->product_name}}</td>
                <td>@if($details->product_coupon != 'no')
                      {{$details->product_coupon}}
                    @else
                      Không có mã giảm giá
                    @endif
                </td>
                <td>{{number_format($details->product_feeship ,0,',','.')}}<sup>đ</sup></td>
                <td>{{$details->product_sales_quantity}}</td>
                <td>{{number_format($details->product_price ,0,',','.')}}<sup>đ</sup></td>
                <td>{{number_format($subtotal ,0,',','.')}}<sup>đ</sup></td>
                
              </tr>
            @endforeach
            <tr>
              <td colspan="2">
                @php
                    $total_coupon = 0;
                @endphp
                @if($coupon_condition == 1)
                  @php
                      $total_after_coupon = ($total * $coupon_number)/100;
                      echo 'Tổng giảm: '.number_format($total_after_coupon ,0,',','.').'<sup>đ</sup>'.'</br>';
                      $total_coupon = $total - $total_after_coupon - $details->product_feeship;
                  @endphp
                @else
                  @php
                    echo 'Tổng giảm: '.number_format($coupon_number ,0,',','.').'<sup>đ</sup>'.'</br>';
                    $total_coupon = $total - $coupon_number - $details->product_feeship;
                  @endphp
                @endif
                Phí giao hàng: {{number_format($details->product_feeship ,0,',','.')}}<sup>đ</sup></br>
                Thanh toán: {{number_format($total_coupon ,0,',','.')}}<sup>đ</sup>
              </td>
            </tr>
          </tbody>
        </table>
        <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
      </div>
    </div>
  </div>
</div>


@endsection