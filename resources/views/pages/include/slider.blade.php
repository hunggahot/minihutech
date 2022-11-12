<section><!--slider-->
    <div class="container-fluid">
        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#slider-carousel" data-slide-to="1"></li>
                <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
                @php
                    $i = 0;
                @endphp
                @foreach($slider as $key => $slide)
                    @php
                        $i++;
                    @endphp
                <div class="item {{$i == 1 ? 'active' : ''}}">
                    
                    <div class="col-sm-12">
                        <img alt="{{$slide->slider_des}}" src="{{asset('public/uploads/slider/'.$slide->slider_image) }}" width="100%" height="200" style="margin-left: -50px;" class="img img-responsive">
                    </div>
                </div>
                @endforeach
            </div>
            
            {{-- <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a> --}}
        </div>
    </div>
</section><!--/slider-->