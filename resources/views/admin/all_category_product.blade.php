@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê danh mục sản phẩm
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
              <th>Tên danh mục</th>
              <th>Thuộc danh mục</th>
              <th>Slug danh mục</th>
              <th>Trạng thái danh mục</th>
              <th></th>
            </tr>
          </thead>
          <style type="text/css">
              #category_order .ui-state-highlight{
                padding:24px;
                background-color: #ffffcc;
                border: 1px dotted #ccc;
                cursor: move;
                margin-top: 12px
              }
          </style>
          <tbody id="category_order">
            @php
                $i = 0;
            @endphp
            @foreach($all_category_product as $key => $cate_pro)
            @php
                $i++;
            @endphp
            <tr id="{{$cate_pro->category_id}}">
              <td><i>{{$i}}</i></td>
              <td>{{ $cate_pro -> category_name }}</td>
              <td>
                @if($cate_pro->category_parent == 0)
                  Danh mục <span style="color: red; font-weight: 700">CHÍNH</span>
                @else
                 @foreach($category_product as $key => $val)
                  @if($val->category_id==$cate_pro->category_parent)
                  Danh mục <span style="color: green; font-weight: 700">CON</span> ({{$val->category_name}})
                  @endif
                 @endforeach
                @endif
              </td>
              <td>{{ $cate_pro -> category_slug }}</td>
              <td><span class="text-ellipsis">
                <?php
                    if($cate_pro -> category_status == 0){
                ?>
                   <a href="{{URL::to('/unactive-category-product/'.$cate_pro -> category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                    <a href="{{URL::to('/active-category-product/' .$cate_pro -> category_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
                </span>
              </td>
              <td>
                <a href="{{URL::to('/edit-category-product/'.$cate_pro -> category_id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{URL::to('/delete-category-product/'.$cate_pro -> category_id)}}" class="active styling-delete" ui-toggle-class="">
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
                        {!!$all_category_product->links()!!}
                    </ul>
                </div>
            </div>
        </div> 
      </footer> --}}
    </div>
  </div>
@endsection