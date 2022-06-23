<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;

use App\Models\Slider;
use App\Models\CategoryProductModels;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoryPostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id(); //có admin_id login
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_category_post(){
        $this->AuthLogin();
        $category = CategoryProductModels::where('category_parent', 0)->orderBy('category_id', 'desc')->get();
        return view('admin.category_post.add_category_post');
    }

    public function all_category_post(){
        $this->AuthLogin();
        
        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->get();

        
        return view('admin.category_post.list_category_post')->with(compact('category_post')); 
    }

    public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $category_post = new CategoryPost();
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_des = $data['cate_post_des'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->save();
        
        session()->put('message', 'Thêm danh mục bài viết thành công');
        return redirect()->back();
    }

    public function edit_category_post($category_product_id){
        $this->AuthLogin();
        $category_post = CategoryPost::find($category_product_id);

        return view('admin.category_post.edit_category_post')->with(compact('category_post')); 
    }

    public function update_category_post(Request $request, $cate_id){
        $data = $request->all();
        $category_post = CategoryPost::find($cate_id);
        $category_post->cate_post_name = $data['cate_post_name'];
        $category_post->cate_post_des = $data['cate_post_des'];
        $category_post->cate_post_status = $data['cate_post_status'];
        $category_post->cate_post_slug = $data['cate_post_slug'];
        $category_post->save();
        
        session()->put('message', 'Cập nhật danh mục bài viết thành công');
        return redirect('/all-category-post');
    }

    public function delete_category_post($cate_id){
        $category_post = CategoryPost::find($cate_id);

        $category_post->delete();
        session()->put('message', 'Xóa danh mục bài viết thành công');
        return redirect()->back();
    }

    public function category_post($cate_post_slug){

    }
}
