@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê danh mục bài viết
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
              <th>Tên danh mục bài viết</th>
              <th>Slug danh mục</th>
              <th>Trạng thái danh mục</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
            @endphp
            @foreach($category_post as $key => $cate_post)
            @php
                $i++;
            @endphp
            <tr>
              <td><i>{{$i}}</i></td>
              <td>{{ $cate_post -> cate_post_name }}</td>
              <td>{{ $cate_post -> cate_post_slug }}</td>
              <td>
                @if($cate_post->cate_post_status == 0)
                    Hiển thị
                @else
                    Ẩn
                @endif
              <td>
                <a href="{{URL::to('/edit-category-post/'.$cate_post -> cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-category-post/'.$cate_post -> cate_post_id)}}" class="active styling-delete" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <!-----import data---->
        <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="file" name="file" accept=".xlsx"><br>

        <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
        </form>

        <!-----export data---->
        <form action="{{url('export-csv')}}" method="POST">
        @csrf
        <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
        </form>
      </div>
      {{-- <footer class="panel-footer">
        <div class="row">
            <div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$category_post->links()!!}
                    </ul>
                </div>
            </div>
        </div> 
      </footer> --}}
    </div>
  </div>
@endsection