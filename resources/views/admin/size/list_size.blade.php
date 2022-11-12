@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê Size sản phẩm
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
              <th>Size</th>
              <th>Trạng thái Size</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($all_size as $key => $size_pro)
            <tr>
              @php
                  $i++;
              @endphp
              <td><i>{{$i}}</i></td>
              <td>{{ $size_pro -> size_number }}</td>
              <td><span class="text-ellipsis">
                <?php
                    if($size_pro -> size_status == 0){
                ?>
                   <a href="{{URL::to('/unactive-size/'.$size_pro -> size_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                    <a href="{{URL::to('/active-size/' .$size_pro -> size_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
                </span></td>
              <td>
                <a href="{{URL::to('/edit-size-product/'.$size_pro -> size_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-size-product/'.$size_pro -> size_id))}}" class="active styling-delete" ui-toggle-class="">
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