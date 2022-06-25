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
        $customer_vip = Customer::where("customer_vip", 1)->get();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Mã khuyến mãi ngày".' '.$now;

        $data = [];
        foreach($customer_vip as $vip){
            $data['email'][] = $vip->customer_email;
        }
        Mail::send('pages.send_mail', $data, function($message) use ($title_mail, $data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'], $title_mail);
        });
        return redirect()->back()->with('message', 'Gửi mã khuyễn mãi cho khách vip thành công');
    }

    public function mail_example(){
        return view('pages.send_coupon');
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

    public function recory_password(Request $request){
        $data = $request->all();
    }
}
