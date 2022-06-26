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
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/images/hutech_icon.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    <?php
    ?>
    <header id="header"><!--header-->
        {{-- <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top--> --}}
        
        <div class="header-middle" style="margin-bottom: -10px;"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/homepage')}}"><img width="40%" src="{{asset('public/frontend/images/hutech_banner.png')}}" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != NULL && $shipping_id == NULL){ //có đăng nhập mà ko có thông tin vận chuyển
                                ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    } elseif($customer_id != NULL && $shipping_id != NULL) { //có đăng nhập và có thông tin vận chuyển
                                ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    } else{
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }
                                ?>
                                <li><a href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL ){
                                ?>
                                <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                <?php
                                    } else {
                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom" id="navbar"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/homepage')}}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Danh Mục<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $key => $cate)
                                            @if($cate->category_parent == 0)
                                                <li><a href="{{URL::to('/category-product/'.$cate->category_slug)}}">{{$cate->category_name}}</a></li>
                                                @foreach($category as $key => $cate_sub)
                                                    @if($cate_sub->category_parent == $cate->category_id)
                                                        <ul>
                                                            <li><a href="{{URL::to('/category-product/'.$cate_sub->category_slug)}}">{{$cate_sub->category_name}}</a></li>
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category_post as $key => $cate_post)
                                        <li><a href="{{URL::to('/hutech-category-post/'.$cate_post->cate_post_slug)}}">{{$cate_post->cate_post_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li> 
                                <li><a href="{{URL::to('/show-cart-ajax')}}">Giỏ Hàng</a></li>
                                <li><a href="{{URL::to('/contact')}}">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/search')}}" autocomplete="off" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box">
                                <input type="text" style="width:60%; margin-right: 0px;" name="keywords_submit" id="keywords" placeholder="Tìm kiếm sản phẩm"/>
                                <div id="search_ajax"></div>
                                <input style="margin-top: 0; color:#666; border-bottom-right-radius: 10px;
                                border-top-right-radius: 10px;" type="submit" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                            </div>
                        </form>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    {{-- slider --}}
    @yield('slider') 
    
    <section style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                {{-- sidebar --}}
                @yield('sidebar') 
                
                <div class="col-sm-9 padding-right">
                    @yield('content') 
                         {{-- gọi file từ đây --}}
                         
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-content">
            <img src="{{asset('public/frontend/images/hutech_banner.png')}}" class="logo" alt="">
        </div>
        <p class="footer-title">about company</p>
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
        <p class="footer-credit">Siêu Thị Mini HUTECH</p>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="s3Xe7law"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',

            client: {
            sandbox: 'AfZnHo8XPiaAIpU4GVXCtk0CVmP64mgLzue1Ctnr-vOQKXxMvSwToNyge2bUKfsLJpLqviRAuOqjMFlb',
            production: 'demo_production_client_id'
            },
            // Customize button (optional)
            locale: 'en_US',
            style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                amount: {
                    total: '0.01',
                    currency: 'USD'
                }
                }]
            });
            },
            // Execute the payment
            onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Cảm ơn bạn đã mua hàng của chúng tôi');
            });
            }
        }, '#paypal-button');

    </script>
    <script type="text/javascript">
        $(document).ready(function(){

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
        $('#keywords').keyup(function(){
            var query = $(this).val();
            if(query != ''){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/autocomplete-ajax')}}',
                    method: "POST",
                    data:{query:query, _token:_token},
                    success:function(data){
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', 'li_search_ajax', function(){
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