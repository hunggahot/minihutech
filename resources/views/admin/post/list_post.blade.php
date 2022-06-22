@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê bài viết
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
              <th>Tên bài viết</th>
              <th>Slug bài viết</th>
              <th>Hình ảnh bài viết</th>
              <th>Mô tả bài viết</th>
              <th>Từ khóa bài viết</th>
              <th>Danh Mục bài viết</th>
              <th>Trạng thái bài viết</th>
              
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($all_post as $key => $post)
            @php
                $i++;
            @endphp
            <tr>
              <td><i>{{$i}}</i></td>
              <td>{{ $post -> post_title }}</td>
              <td>{{ $post -> post_slug }}</td>
              <td><img src="public/uploads/post/{{ $post -> post_image }}" height="100" width="100" alt=""></td>
              <td>{!! $post -> post_sum !!}</td>
              <td>{{ $post -> post_meta_keywords }}</td>
              <td>{{ $post -> cate_post_id }}</td>
              <td>
                @if($post -> post_status == 0)
                    Hiển thị
                @else
                    Ẩn
                @endif
              </td>
              <td>
                <a href="{{URL::to('/edit-post/'.$post -> post_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-post/'.$post -> post_id)}}" class="active styling-delete" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
            <div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$all_post->links()!!}
                    </ul>
                </div>
            </div>
        </div> 
      </footer>
    </div>
  </div>
@endsection