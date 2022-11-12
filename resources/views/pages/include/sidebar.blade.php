<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh Mục</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

            @foreach($category as $key => $cate)
            <div class="panel panel-default">

                @if($cate->category_parent == 0)
                <div class="panel-heading">
                    <h4 class="panel-title">

                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->category_slug}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$cate->category_name}}
                        </a>
                    </h4>
                </div>

                <div id="{{$cate->category_slug}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($category as $key => $cate_sub)
                            @if($cate_sub->category_parent == $cate->category_id)
                            <li><a href="{{URL::to('/category-product/'.$cate_sub->category_slug)}}">{{$cate_sub->category_name}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div><!--/category-products-->
    
        <div class="brands_products" style="margin-bottom: 20px;"><!--brands_products-->
            <h2>Thương Hiệu</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $key => $brand)
                    <li><a href="{{URL::to('/brand-product/'.$brand->brand_slug)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div><!--/brands_products-->
    </div>
</div>