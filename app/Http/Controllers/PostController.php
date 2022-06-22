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
        $all_post = Post::orderBy('post_id')->paginate(10);
        
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
}
