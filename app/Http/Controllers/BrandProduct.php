<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
session_start();

class BrandProduct extends Controller
{
    //Admin Controller
    public function AuthLogin(){
        $admin_id = Session::get('admin_id'); //có admin_id login
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();

        // $all_brand_product = DB::table('tbl_brand')->get(); static mô hình hướng đối tượng
        $all_brand_product = Brand::orderBy('brand_id', 'desc')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product); //admin layout chưa cả all brand product gán vào biến manager
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();

        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_des = $data['brand_product_des'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        
        session()->put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        session()->put('message', 'Đã cập nhật trạng thái thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        session()->put('message', 'Đã cập nhật trạng thái thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get(); 2 cách dùng
        // $edit_brand_product = Brand::where('brand_id' ,$brand_product_id)->get();

        $edit_brand_product = Brand::find($brand_product_id);
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request ,$brand_product_id){
        $this->AuthLogin();

        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_des = $data['brand_product_des'];
        $brand->save();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_des'] = $request->brand_product_des;
        // DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        session()->put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        session()->put('message', 'Xoá thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //Homepage Controller
    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')->where('tbl_product.brand_id', $brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
