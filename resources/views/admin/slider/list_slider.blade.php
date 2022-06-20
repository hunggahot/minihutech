@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê slider
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
              <th>Tên slider</th>
              <th>Hình ảnh</th>
              <th>Mô tả</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($all_slide as $key => $slide)
            @php
                $i++;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{ $slide -> slider_name }}</td>
              <td><img src="public/uploads/slider/{{ $slide->slider_image }}" height="120" width="500"></td>
              <td>{{ $slide -> slider_des }}</td>
              <td><span class="text-ellipsis">
                <?php
                    if($slide -> slider_status == 1){
                        ?>
                <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
                </span></td>
              <td>
                <a onclick="return confirm('Bạn có chắc là muốn xóa?')" href="{{URL::to('/delete-slide/'.$slide->slider_id)}}" class="active styling-edit" ui-toggle-class="">
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