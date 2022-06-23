<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CategoryPost;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Product as ModelsProduct;
use App\Models\Rating;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

session_start();

class Product extends Controller
{
    //Admin Controller
    public function AuthLogin(){
        $admin_id = Auth::id();//có admin_id login
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();
        }
    }

    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'HUTECHAdmin';
        $comment->save();
    }

    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id', 'desc')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment', 'comment_rep'));
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_product_id = $product_id;
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment','=',0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $cmt){
            $output .= '
            <div class="row style_comment">
                        <div class="col-md-2">
                          
                            <img width="100%" src="'.url('/public/frontend/images/147142.png').'" class="img img-responsive img-thumbnail">
                        </div>
                        <div class="col-md-10">
                            <p style="color: blue">@'.$cmt->comment_name.'</p>
                            <p style="color: #000">'.$cmt->comment_date.'</p>
                            <p>'.$cmt->comment.'</p>
                        </div>
                    </div>
                    <p></p>
                    ';

                    foreach($comment_rep as $key => $rep) {
                        if($rep->comment_parent_comment == $cmt->comment_id){
                            $output.='
                            <div class="row style_comment" style="margin: 5px 40px">
                                        <div class="col-md-2">
                                          
                                            <img width="80%" src="'.url('/public/frontend/images/194938.png').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color: green">@Admin</p>
                                            <p style="color: #000">'.$rep->comment.'</p>
                                            <p></p>
                                        </div>
                                    </div>
                                    <p></p>';
                        }
                    }

        }
        echo $output;
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=','tbl_product.brand_id')
        ->orderBy('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        
        return view('admin_layout')->with('admin.all_product', $manager_product); 
    }

    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request->product_tags;
        $data['product_slug'] = $request->product_slug;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_des'] = $request->product_des;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        // $data['product_image'] = $request->product_image;

        $get_image = $request->file('product_image');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.'-'.rand(0, 9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            File::copy($path.$new_image, $path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        } 
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
            
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Đã cập nhật trạng thái sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Đã cập nhật trạng thái sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderBy('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();

        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function update_product(Request $request, $product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_tags'] = $request->product_tags;
        $data['product_slug'] = $request->product_slug;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_des'] = $request->product_des;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.'-'.rand(0, 9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        } 
           
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xoá sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //Home Controller
    public function product_details(Request $request, $product_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        $product_details = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=','tbl_product.brand_id')
        ->where('tbl_product.product_slug', $product_slug)->get();

        
        foreach($product_details as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $product_cate = $value->category_name;
            $cate_slug = $value->category_slug;
            
            //Seo
            $meta_des = $value->product_des;
            $meta_keywords =  $value->product_slug;
            $meta_title =  $value->product_name;
            $meta_canonical =  $request->url();
            //--Seo
        }

        //gallery
        $gallery = Gallery::where('product_id', $product_id)->get();
        
        $product_related = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id', '=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_slug', [$product_slug])->paginate(6);

        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating); // làm tròn số thành số nguyên

        return view('pages.product.show_details')->with('category', $cate_product)->with('brand', $brand_product)->with('product_details', $product_details)->with('related', $product_related)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post)->with('gallery', $gallery)->with('product_cate', $product_cate)->with('cate_slug', $cate_slug)->with('rating', $rating);
    }

    public function tag(Request $request, $product_tag){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();

        $tag = str_replace("-", " ", $product_tag);
        $pro_tag = ModelsProduct::where('product_status', 0)->where('product_name', 'like', '%'.$tag.'%')->orWhere('product_tags', 'like', '%'.$tag.'%')->orWhere('product_slug', 'like', '%'.$tag.'%')->get();

        //Seo
        $meta_des = 'abc';
        $meta_keywords = 'abc';
        $meta_title =  'abc';
        $meta_canonical =  $request->url();
        //--Seo
    
        return view('pages.product.tag')->with('slider', $slider)->with('category_post', $category_post)->with('category', $cate_product)->with('brand', $brand_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('product_tag', $product_tag)->with('pro_tag', $pro_tag);
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
}
