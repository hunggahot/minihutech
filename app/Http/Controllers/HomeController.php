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
use App\Models\Product;
use App\Models\Slider;
session_start();

class HomeController extends Controller
{
    public function index(Request $request){
        //Seo
        $meta_des = "Siêu thị Mini giá rẻ, chất lượng. Đặc biệt dành cho sinh viên HUTECH";
        $meta_keywords = "thuc pham, thực phẩm, thức uống";
        $meta_title = "Siêu thị Mini HUTECH | Trang chủ";
        $meta_canonical = $request->url();
        //--Seo

        //category post
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();

        //slider
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(3)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_parent', 'desc')->orderBy('category_order', 'asc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby(DB::raw('RAND()'))->paginate(8); 

        $cate_pro_tabs =  CategoryProductModels::where('category_parent','<>', 0)->orderBy('category_order', 'asc')->get();
        
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post)->with('cate_pro_tabs', $cate_pro_tabs); //gọi file home.blade.php từ folder pages
    }

    public function search(Request $request){
        //Seo
        $meta_des = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $meta_canonical = $request->url();
        //--Seo

        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->get();

        //slider
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $keywords = $request->keywords_submit;

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keywords.'%')->get();


        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post);
    }

    public function autocomplete_ajax(Request $request){
        $data = $request->all(); //bắt tất cả dữ liệu gửi qua hàm này
        if($data['query']){
            $product = Product::where('product_status', 0)->where('product_name', 'like', '%'.$data['query'].'%')->get(); //lấy tên sản phẩm so sánh dữ liệu được đổ vào với % like là tìm chuỗi ký tự với bất kỳ độ dài nào
            $output = '<ul class="dropdown-menu" style="display: block; position: relative">'; 
            foreach($product as $key => $val){ // trả về dữ liệu $val đổ dữ liệu
                $output .= '
                <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

   
}
