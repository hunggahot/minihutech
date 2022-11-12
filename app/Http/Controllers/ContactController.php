<?php

namespace App\Http\Controllers;

use App\Models\CategoryPost;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
session_start();

class ContactController extends Controller
{
    public function contact(Request $request){
        //Seo
        $meta_des = "Liên hệ";
        $meta_keywords = "liên hệ";
        $meta_title = "Liên hệ với chúng tôi";
        $meta_canonical = $request->url();
        //--Seo

        //category post
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();

        //slider
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();


        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        return view('pages.contact.contact')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post);;
    }
}
