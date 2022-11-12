@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê bình luận
      </div>
      <div id="notify_comment"></div>
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
              <th>Duyệt</th>
              <th>Tên người gửi</th>
              <th>Ngày gửi</th>
              <th>Bình luận</th>
              <th>Sản phẩm</th>
              <th>Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($comment as $key => $cmt)
            @php
                $i++;
            @endphp
            <tr>
              <td><i>{{$i}}</i></td>
              <td>
                @if($cmt -> comment_status == 1)
                    <input type="button" data-comment_status="0" data-comment_id="{{$cmt->comment_id}}" id="{{$cmt->comment_product_id}}" class="btn btn-primary btn-xs comment_accept_btn" value="Duyệt">
                @else
                    <input type="button" data-comment_status="1" data-comment_id="{{$cmt->comment_id}}" id="{{$cmt->comment_product_id}}" class="btn btn-danger btn-xs comment_accept_btn" value="Hủy">
                @endif
                
              </td>
              <td>{{ $cmt -> comment_name }}</td>
              <td>{{ $cmt -> comment_date }}</td>
              <td>{{ $cmt -> comment }}
                <style type="text/css">
                    ul.list_rep li{
                        list-style-type: decimal;
                        color: blue;
                        margin: 5px 40px;
                    }
                </style>
                <ul class="list_rep">
                Trả lời:
                    @foreach($comment_rep as $key => $rep)
                        @if($rep->comment_parent_comment == $cmt->comment_id)
                        <li> {{$rep->comment}}</li>
                        @endif
                    @endforeach
                </ul>
                @if($cmt -> comment_status == 0)
                <br><textarea class="form-control reply_comment_{{$cmt->comment_id}}" rows="5" ></textarea> 
                <br><button class="btn btn-default btn-reply-comment" data-product_id="{{$cmt->comment_product_id}}" data-comment_id="{{$cmt->comment_id}}">Trả lời</button>
                    
                @else
                    
                @endif 
              </td>
              <td><a href="{{url('/product-details/'.$cmt->product->product_slug)}}" target="_blank">{{ $cmt -> product-> product_name }}</a></td>
              <td>
                <a href="" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="" class="active styling-delete" ui-toggle-class="">
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
@endsection