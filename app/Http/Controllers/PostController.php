<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
session_start();

class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();//có admin_id login
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_post(){
        $this->AuthLogin();
        $cate_post = CategoryPost::orderBy('cate_post_id', 'desc')->get();

        return view('admin.post.add_post')->with(compact('cate_post'));
        
    }

    public function save_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_sum = $data['post_sum'];
        $post->post_content = $data['post_content'];
        $post->post_meta_des = $data['post_meta_des'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên hình ảnh
            $name_image = current(explode('.', $get_name_image));

            $new_image = $name_image.'-'.rand(0, 9999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/uploads/post', $new_image);

            $post->post_image = $new_image;

            $post->save();
            Session::put('message', 'Thêm bài viết thành công');
            return Redirect::back();
        } else{
            Session::put('message', 'Bài viết phải có ít nhất một hình ảnh');
            return Redirect::back();
        }
        
        session()->put('message', 'Thêm danh mục bài viết thành công');
        return redirect()->back();
    }

    public function all_post(){
        $this->AuthLogin();

        $all_post = Post::with('cate_post')->orderBy('post_id')->get();
        
        return view('admin.post.list_post')->with(compact('all_post')); 
    }

    public function delete_post($post_id){
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        if($post_image){
            $path = 'public/uploads/post/'.$post_image;
            unlink($path);
        }
        $post->delete();

        Session::put('message', 'Xóa bài viết thành công');
        return redirect()->back();
    }

    public function edit_post($post_id){
        $cate_post = CategoryPost::orderBy('cate_post_id')->get();
        $post = Post::find($post_id);
        
        return view('admin.post.edit_post')->with(compact('post', 'cate_post'));
    }

    public function update_post(Request $request, $post_id){
        $this->AuthLogin();
        $data = $request->all();
        $post = Post::find($post_id);

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_sum = $data['post_sum'];
        $post->post_content = $data['post_content'];
        $post->post_meta_des = $data['post_meta_des'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];

        $get_image = $request->file('post_image');
        if($get_image){
            //xóa ảnh cũ
            $post_image_old = $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);

            //cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên hình ảnh
            $name_image = current(explode('.', $get_name_image));

            $new_image = $name_image.'-'.rand(0, 9999).'.'.$get_image->getClientOriginalExtension();

            $get_image->move('public/uploads/post', $new_image);

            $post->post_image = $new_image;

        } 
        $post->save();
        session()->put('message', 'Cập nhật bài viết thành công');
        return redirect('/all-post');
    }

    public function hutech_category_post(Request $request, $post_slug){
        

        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->get();

        //slider
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $catepost = CategoryPost::where('cate_post_slug', $post_slug)->take(1)->get();

        foreach($catepost as $key => $cate) {

            $meta_des = $cate->cate_post_des;
            $meta_keywords = $cate->cate_post_slug;
            $meta_title = $cate->cate_post_name;
            $cate_id = $cate->cate_post_id;
            $meta_canonical = $request->url();
        }

        $post = Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_id)->paginate(10);
        

        return view('pages.post.category_post')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post)->with('post', $post);
    }

    public function post(Request $request, $post_slug){
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->get();

        //slider
        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $post = Post::with('cate_post')->where('post_status', 0)->where('post_slug', $post_slug)->take(1)->get();

        foreach($post as $key => $p) {

            $meta_des = $p->post_meta_des;
            $meta_keywords = $p->post_meta_keywords;
            $meta_title = $p->post_title;
            // $cate_id = $p->cate_post_id;
            $cate_post_id = $p->cate_post_id;
            $meta_canonical = $request->url();
        }

        $related =  Post::with('cate_post')->where('post_status', 0)->where('cate_post_id', $cate_post_id)->whereNotIn('post_slug', [$post_slug])->take(5)->get();

        return view('pages.post.post')->with('category', $cate_product)->with('brand', $brand_product)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post)->with('post', $post)->with('related', $related);
    }
}
