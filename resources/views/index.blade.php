<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{------------------------------------ SEO -----------------------------------}}
    <meta name="description" content="{{$meta_des}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="">
    <link rel="canonical" href="{{$meta_canonical}}">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" type="image/x-icon" href="">
    {{------------------------------------ SEO -----------------------------------}}

    {{-- <meta property="og:site_name" content="" />
    <meta property="og:description" content="{{$meta_des}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$meta_canonical}}" />
    <meta property="og:type" content="website" /> --}}

    <title>{{$meta_title}}</title>
    <link href="{{asset('public/frontendss/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontendss/css/prettify.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontendss/images/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <header id="header" style="margin-top: 10px">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    <div class="logo pull-left">
                        <a href="{{URL::to('/homepage')}}"><img src="{{asset('public/frontendss/images/logo.png')}}" alt="" width="80" height="80"></a></li>
                    </div>
                </div>
                <div class="col-sm-6" style="margin-top: 30px">
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{URL::to('/homepage')}}" class="active">Trang Chủ</a></li>
                            <li class="dropdown"><a href="#">Sản Phẩm<i class="fa fa-angle-down"></i></a></li>
                            <li><a href="{{URL::to('/contact')}}">Liên Hệ</a></li>
                            <li><a href="{{URL::to('/contact')}}">Về Chúng Tôi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-5" style="margin-top: 25px">
                    <div class="row mainmenu pull-right">
                        <form action="{{URL::to('/search')}}" autocomplete="off" method="POST" class="col-sm-8 pull-left" role="search">
                            {{ csrf_field() }}
                            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                            <div id="search_ajax"></div>
                        </form>
                        <ul class="col-sm-4 nav navbar-nav collapse navbar-collapse pull-right" style="margin-top: 5px">
                            <li><a href="{{URL::to('/show-cart-ajax')}}" ><i class="fa fa-shopping-cart"></i></a></li>
                            <li class="dropdown text-small"><a href="#"><i class="fa fa-user"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{URL::to('/login-checkout')}}">Sign in</a></li>
                                    <li><a href="{{URL::to('/register-user')}}">Sign up</a></li>
                                    <li><a href="#">Info</a></li>
                                    <li><hr class="solid"></li>
                                    <li><a href="#">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <hr/>

    @yield('slider') 


    @yield('category')


    <div class="container">
        @yield('content')
    </div>
    <hr/>

    <footer id="footer"><!--Footer-->
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <img src="{{asset('public/frontendss/images/logo.png')}}" class="logo" alt="">
                </div>
                <div class="col-sm-8 pull-right" style="margin-top: 30px">
                    <form>
                        <h5 class="info">Subscribe to our newsletter</h5>
                        <p class="info">Monthly digest of what's new and exciting from us.</p>
                        <label for="newsletter1" class="visually-hidden info">Email address</label>
                        <div class="row">
                          <input id="newsletter1" type="text" class="form-control col-sm-1" placeholder="Email address" style="width: 70%; margin-left: 15px">
                          <button class="btn btn-dark col-sm-2" type="button">Subscribe</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
        <p class="footer-title info">about company</p>
        <p class="info">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit recusandae ratione necessitatibus voluptatum, aliquam sunt voluptates ipsam aspernatur magni natus porro officiis veritatis accusamus, vel cum, odit dicta laborum dolore vero unde et eaque earum pariatur? Sunt dolores debitis vero aliquam tenetur sint reiciendis cumque aut veritatis at perspiciatis eveniet rerum iusto delectus possimus blanditiis asperiores non nulla similique provident tempore maiores numquam, consequuntur ipsa. Provident dolore beatae dolores est iste veritatis magnam nobis fugit quaerat maiores quod tenetur ullam, quis dicta amet. Dolorum odit modi harum, quas magnam sequi qui tempora quia? Exercitationem eius dolores possimus asperiores iusto enim.</p>
        <p class="info">support emails - lamquochung03042001@gmail.com</p>
        <p class="info">telephone - 0362282969</p>
        <div class="footer-social-container">
            <div>
                <a href="" class="social-link">terms & services</a>
                <a href="" class="social-link">privacy page</a>
            </div>
            <div>
                <a href="" class="social-link">facebook</a>
                <a href="" class="social-link">zalo</a>
            </div>
        </div>
        <p class="footer-credit">Hph Store</p>
        
    </footer><!--/Footer-->

    <script src="{{asset('public/frontendss/js/jquery.js')}}"></script>
<script src="{{asset('public/frontendss/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontendss/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/frontendss/js/price-range.js')}}"></script>
<script src="{{asset('public/frontendss/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontendss/js/main.js')}}"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="s3Xe7law"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{asset('public/frontendss/js/sweetalert.min.js')}}"></script>
<script src="{{asset('public/frontendss/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset('public/frontendss/js/lightslider.js')}}"></script>
<script src="{{asset('public/frontendss/js/prettify.js')}}"></script>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script type="text/javascript">
    $(document).ready(function(){ //bộ lọc sản phẩm, reload sau khi chọn

        $('#sort').on('change', function(){
            var url = $(this).val();
            if(url){
                window.location = url;
            }
            return false;
        });
    });
</script>

<script type="text/javascript">
    window.onscroll = function() {
        sticky_navbar()
    };

    var navbar = document.getElementById("navbar");

    var sticky = navbar.offsetTop;

    function sticky_navbar(){
        if(window.pageYOffset >= sticky){
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var cate_id = $('.tabs_pro').data('id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url: '{{url('/product-tabs')}}',
                method: "POST",
                data:{cate_id:cate_id, _token:_token},
                success:function(data){
                    $('#tabs_product').html(data);
                }
            });
    });

    $('.tabs_pro').click(function(){
        var cate_id = $(this).data('id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url: '{{url('/product-tabs')}}',
                method: "POST",
                data:{cate_id:cate_id, _token:_token},
                success:function(data){
                    $('#tabs_product').html(data);
                }
            });
    })
</script>
<script type="text/javascript">
    function remove_background(product_id){
        for(var count = 1; count <= 5; count++){
            $('#'+product_id+'-'+count).css('color', '#ccc');
        }
    }

    //hover đánh giá sao
    $(document).on('mouseenter', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');

        remove_background(product_id);

        for(var count = 1; count<=index; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });

    //nhả hover không đánh giá sao
    $(document).on('mouseleave', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
        var rating = $(this).data("rating");

        remove_background(product_id);

        for(var count = 1; count <= rating; count++){
            $('#'+product_id+'-'+count).css('color', '#ffcc00');
        }
    });

    //click đánh giá sao
    $(document).on('click', '.rating', function(){
        var index = $(this).data("index");
        var product_id = $(this).data('product_id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url: '{{url('insert-rating')}}',
                method: "POST",
                data:{index:index, product_id:product_id, _token:_token},
                success:function(data){
                    if(data == 'done'){
                        alert("Bạn đã đánh giá "+index+" sao trên 5 sao");
                    } else{
                        alert("Lỗi đánh giá");
                    }
                }
            });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        load_comment();
        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/load-comment')}}',
                method: "POST",
                data:{product_id:product_id, _token:_token},
                success:function(data){
                    $('#comment_show').html(data);
                }
            });
        }
        $('.send-comment').click(function(){
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content= $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/send-comment')}}',
                method: "POST",
                data:{product_id:product_id, _token:_token, comment_name:comment_name, comment_content:comment_content},
                success:function(data){
                    $('#notify_comment').html('<p class="text text-success">Thêm bình luận thành công, bình luận đang được chờ duyệt</p>')
                    load_comment();
                    $('#notify_comment').fadeOut(10000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                }
            });
        })
    });
</script>

<script type="text/javascript">
    $('#keywords').keyup(function(){ //keyup: nhập vào ký tự nào thì ra ký tự đó
        var query = $(this).val(); //this: lấy dữ liệu dựa vào id keywords
        if(query != ''){ //nếu không rỗng -> lấy token rồi thực hiện ajax
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/autocomplete-ajax')}}', //kích hoạt ajax truyền url theo phương thức post
                method: "POST",
                data:{query:query, _token:_token}, // gửi qua query(từ khóa đã nhập) và token
                success:function(data){ 
                    $('#search_ajax').fadeIn(); //đổ dữ liệu hiển thị sản phẩm (fadein: hiệu ứng mờ)
                    $('#search_ajax').html(data); //đổ html dữ liệu vào
                }
            });
        }else{
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click', 'li_search_ajax', function(){ //click chuột kích hoạt
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#imageGallery').lightSlider({
            gallery:true,
            item:1,
            loop:true,
            thumbItem:4,
            slideMargin:0,
            enableDrag: false,
            currentPagerPosition:'left',
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#imageGallery .lslide'
                });
            }   
        });  
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){
      $('.send_order').click(function(){
          swal({
            title: "Xác nhận đơn hàng",
            text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Cảm ơn, Mua hàng",

              cancelButtonText: "Đóng,chưa mua",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm){
               if (isConfirm) {
                  var shipping_email = $('.shipping_email').val();
                  var shipping_name = $('.shipping_name').val();
                  var shipping_address = $('.shipping_address').val();
                  var shipping_phone = $('.shipping_phone').val();
                  var shipping_notes = $('.shipping_notes').val();
                  var shipping_method = $('.payment_select').val();
                  var order_fee = $('.order_fee').val();
                  var order_coupon = $('.order_coupon').val();
                  var _token = $('input[name="_token"]').val();

                  $.ajax({
                      url: '{{url('/confirm-order')}}',
                      method: 'POST',
                      data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                      success:function(){
                         swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                      }
                  });

                  window.setTimeout(function(){ 
                      location.reload();
                  } ,3000);

                } else {
                  swal("Đóng", "Đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");

                }
        
          });

         
      });
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
            var id = $(this).data('id_product');
            var cart_product_id = $('.cart_product_id_' + id).val();
            var cart_product_name = $('.cart_product_name_' + id).val();
            var cart_product_image = $('.cart_product_image_' + id).val();
            var cart_product_quantity = $('.cart_product_quantity_' + id).val(); // số lượng có ở trong kho
            var cart_product_price = $('.cart_product_price_' + id).val();
            var cart_product_qty = $('.cart_product_qty_' + id).val(); // số lượng khách đặt
            var _token = $('input[name = "_token"]').val();
            if(parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
                alert('Số lượng trong kho còn ' + cart_product_quantity);
            }else {

                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id, cart_product_name:cart_product_name, cart_product_image:cart_product_image, cart_product_price:cart_product_price, cart_product_qty:cart_product_qty, _token:_token, cart_product_quantity:cart_product_quantity},
                    success:function(){
                        swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{url('/show-cart-ajax')}}";
                        });

                        
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.choose').on('change',function(){
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
       
        if(action=='city'){
            result = 'province';
        }else{
            result = 'wards';
        }
        $.ajax({
            url : '{{url('/select-delivery-home')}}',
            method: 'POST',
            data:{action:action,ma_id:ma_id,_token:_token},
            success:function(data){
               $('#'+result).html(data);     
            }
        });
    });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.calculate_delivery').click(function(){
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            var _token = $('input[name="_token"]').val();
            if(matp == '' && maqh =='' && xaid ==''){
                alert('Làm ơn chọn để tính phí vận chuyển');
            }else{
                $.ajax({
                url : '{{url('/calculate-fee')}}',
                method: 'POST',
                data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                success:function(){
                   location.reload(); 
                }
                });
            } 
    });
});
</script>
</body>
</html>