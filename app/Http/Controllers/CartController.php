<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use App\Models\Slider;
session_start();

class CartController extends Controller
{
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = Session::get('coupon');
                if($coupon_session == true){
                    $is_valid = 0;
                    if($is_valid == 0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        session()->put('coupon', $cou);
                    }
                } else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    session()->put('coupon', $cou);
                }
                session()->save();
                return Redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        } else{
            return Redirect()->back()->with('error', 'Sai mã giảm giá');
        }
    }

    public function show_cart_ajax(Request $request){
         //Seo
         $meta_des = "Giỏ hàng của bạn";
         $meta_keywords = "Giỏ hàng AJAX";
         $meta_title = "Giỏ hàng AJAX";
         $meta_canonical = $request->url();
         //--Seo

         $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
 
         $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
         $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
         $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();
         
         return view('pages.cart.cart_ajax')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post);
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0, 26), 5);
        $cart = Session::get('cart');
        if($cart == true){
            $is_valid = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_valid++;
                }
            }
            if($is_valid == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                );
                session()->put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
            );
            session()->put('cart', $cart);
        }
       
       session()->save();
    }

    public function save_cart(Request $request){
        
        $productId = $request->product_id_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price; //mặc dù ko dùng tới nhưng phải khai báo vì đó nằm trong vendor shopping cart đã cài trước đó
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10); //set % thuế
        // Cart::destroy();
        
        return Redirect::to('/show-cart-ajax');
    }
    
    public function show_cart(Request $request){
        //Seo
        $meta_des = "Giỏ hàng của bạn";
        $meta_keywords = "Giỏ hàng";
        $meta_title = "Giỏ hàng";
        $meta_canonical = $request->url();
        //--Seo

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();
        
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider);
    }

    public function delete_product_cart($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            session()->put('cart', $cart);
            return Redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        } else{
            return Redirect()->back()->with('message', 'Xóa sản phẩm thất bại');
        }
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart == true){
            $message = '';

            foreach($data['cart_qty'] as $key => $qty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id'] == $key && $qty < $cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color: green">'.$i.') Cập nhật số lượng: '.$cart[$session]['product_name'].' thành công</p>';
                    } elseif($val['session_id'] == $key && $qty > $cart[$session]['product_quantity']){
                        $message.='<p style="color: red">'.$i.') Cập nhật số lượng: '.$cart[$session]['product_name'].' thất bại</p>';
                    }
                }
            }

            session()->put('cart', $cart);
            return Redirect()->back()->with('message', $message);
        } else {
            return Redirect()->back()->with('message', 'Cập nhật số lượng sản phẩm thất bại');
        }
    }

    public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart == true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return Redirect()->back()->with('message', 'Xóa tất cả sản phẩm thành công');
        }
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);

        return Redirect::to('/show-cart');
    }

    public function update_cart_qty(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);

        return Redirect::to('/show-cart');
    }
}
