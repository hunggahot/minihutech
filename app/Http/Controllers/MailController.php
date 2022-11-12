<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Models\CategoryPost;
use App\Models\CategoryProductModels;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function send_mail(){
        $to_name = "Siêu Thị Mini HUTECH";
        $to_email = "lamquochung03042001@gmail.com";

        $data = array("name"=> "Mail từ tài khoản khách hàng", "body" => "Mail nói về vấn đề hàng hóa");

        Mail::send('pages.send_mail', $data, function ($message) use($to_name, $to_email){
            $message->from($to_email)->subject('Test lần đầu làm chuyện ấy');
            $message->to($to_email, $to_name);
        });
        return redirect('/')->with('message', '');
    }

    public function send_coupon(){
        //get customer
        $customer = Customer::where("customer_vip",'<>', 1)->get();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        
        $title_mail = "Mã khuyến mãi ngày".' '.$now;

        $data = [];
        foreach($customer as $normal){
            $data['email'][] = $normal->customer_email;
        }
        Mail::send('pages.send_coupon', $data, function($message) use ($title_mail, $data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return redirect()->back()->with('message', 'Gửi mã khuyễn mãi cho khách thành công');
    }

    public function send_coupon_vip(){
        //get customer
        $customer_vip = Customer::where("customer_vip", 1)->get();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        
        $title_mail = "Mã khuyến mãi ngày".' '.$now;

        $data = [];
        foreach($customer_vip as $vip){
            $data['email'][] = $vip->customer_email;
        }
        Mail::send('pages.send_coupon_vip', $data, function($message) use ($title_mail, $data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return redirect()->back()->with('message', 'Gửi mã khuyễn mãi cho khách vip thành công');
    }

    public function mail_example(){
        return view('pages.send_coupon');
    }

    public function reset_new_pass(Request $request){
        $data = $request->all();
        $token_random = Str::random();
        $customer = Customer::where('customer_email','=', $data['email'])->where('customer_token', '=', $data['token'])->get();
        $count = $customer->count();
        if($count>0){
            foreach($customer as $key => $cus){
                $customer_id = $cus -> customer_id;
            }
            $reset = Customer::find($customer_id);
            $reset->customer_password = md5($data['password_account']);
            $reset->customer_token = $token_random;
            $reset->save();
            return redirect('login-checkout')->with('message', 'Mật khẩu đã được cập nhật');
        } else{
            return redirect('forgot-password')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn');
        }
    }

    public function update_new_pass(Request $request){
         //Seo
         $meta_des = "Quên mật khẩu";
         $meta_keywords = "Quên mật khẩu";
         $meta_title = "Quên mật khẩu";
         $meta_canonical = $request->url();
         //--Seo
 
         //category post
         $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
 
         //slider
         $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(3)->get();
 
 
         $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_parent', 'desc')->orderBy('category_order', 'asc')->get();
 
         $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
 
         $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6); 
 
         $cate_pro_tabs =  CategoryProductModels::where('category_parent','<>', 0)->orderBy('category_order', 'asc')->get();
         
         return view('pages.checkout.new_password')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post)->with('cate_pro_tabs', $cate_pro_tabs);
    }

    public function forgot_password(Request $request){
        //Seo
        $meta_des = "Quên mật khẩu";
        $meta_keywords = "Quên mật khẩu";
        $meta_title = "Quên mật khẩu";
        $meta_canonical = $request->url();
        //--Seo

        //category post
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();

        //slider
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(3)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_parent', 'desc')->orderBy('category_order', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(6); 

        $cate_pro_tabs =  CategoryProductModels::where('category_parent','<>', 0)->orderBy('category_order', 'asc')->get();
        
        return view('pages.checkout.forgot_password')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post)->with('cate_pro_tabs', $cate_pro_tabs);
        
    }

    public function recover_password(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');

        $title_mail = "Lấy lại mật khẩu".' '.$now;

        $customer = Customer::where('customer_email', '=', $data['email_account'])->get();
        foreach($customer as $key => $value){
            $customer_id = $value->customer_id;
        }

        if($customer){
            $count_customer = $customer->count();
            if($count_customer == 0){
                return redirect()->back()->with('error', 'Email chưa được đăng ký để khôi phục mật khẩu');
            }else{
                $token_random = Str::random();
                $customer = Customer::find($customer_id);
                $customer->customer_token = $token_random;
                $customer->save();

                //send mail
                $to_email = $data['email_account']; //send to this email
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);

                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,'email'=>$data['email_account']);

                Mail::send('pages.checkout.forget_password_notify', ['data' => $data], function($message) use ($title_mail, $data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'], $title_mail);
                });

                //send mail
                return redirect()->back()->with('message', 'Gửi mail thành công, vui lòng check mail để reset password');
            }
        }
    }
}
