<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use App\Models\CategoryPost;
use App\Models\Slider;
use App\Models\CategoryProductModels;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

session_start();

class CategoryProduct extends Controller
{

    //Admin Controller
    public function AuthLogin(){
        $admin_id = Auth::id(); //có admin_id login
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();
        }
    }

    public function arrange_category(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $cate_id = $data["page_id_array"];
        foreach($cate_id as $key => $value){
            $category = CategoryProductModels::find($value);
            $category->category_order = $key;
            $category->save();
        }

        echo 'Updated';
    }

    public function add_category_product(){
        $this->AuthLogin();
        $category = CategoryProductModels::where('category_parent', 0)->orderBy('category_id', 'desc')->get();
        return view('admin.add_category_product')->with(compact('category'));
    }

    public function all_category_product(){
        $this->AuthLogin();
        $category_product = CategoryProductModels::where('category_parent', 0)->orderBy('category_id', 'desc')->get();

        $all_category_product = DB::table('tbl_category_product')->orderBy('category_parent', 'desc')->orderBy('category_order', 'asc')->get();

        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product)->with('category_product', $category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product); //admin layout chưa cả all category product gán vào biến manager
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_slug'] = $request->category_slug;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_des'] = $request->category_product_des;
        $data['category_parent'] = $request->category_parent;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        session()->put('message', 'Đã cập nhật trạng thái danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        session()->put('message', 'Đã cập nhật trạng thái danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $category = CategoryProductModels::orderBy('category_id', 'desc')->get();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product)->with('category', $category);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request ,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_slug'] = $request->category_slug;
        $data['category_des'] = $request->category_product_des;

        DB::table('tbl_category_product')->where('category_id', $category_product_id)->update($data);
        session()->put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_product_id)->delete();
        session()->put('message', 'Xoá danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //Homepage Controller
    public function show_category_home(Request $request, $category_slug){

        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderBy('category_id', 'desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderBy('brand_id', 'desc')->get();

        $slider = Slider::orderBy('slider_id','desc')->where('slider_status','1')->take(4)->get();

        // $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')->where('tbl_category_product.category_slug', $category_slug)->paginate(6);

        $category_post = CategoryPost::orderBy('cate_post_id', 'desc')->where('cate_post_status', '0')->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_slug', $category_slug)->limit(1)->get();
        
        $category_by_slug = CategoryProductModels::where('category_slug', $category_slug)->get();


        foreach($category_by_slug as $key => $cate){
            $category_id = $cate->category_id;
        }

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by == 'giam_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_price', 'desc')->paginate(8)->appends(request()->query());
            } elseif($sort_by == 'tang_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_price', 'asc')->paginate(8)->appends(request()->query());
            } elseif($sort_by == 'kytu_az'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_name', 'asc')->paginate(8)->appends(request()->query());
            } elseif($sort_by == 'kytu_za'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_name', 'desc')->paginate(8)->appends(request()->query());
            }
        } else{
            $category_by_id = Product::with('category')->where('category_id', $category_id)->orderBy('product_id', 'desc')->paginate(6);
        }

        foreach($cate_product as $key => $val){
            //Seo
            $meta_des = $val->category_des;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $meta_canonical = $request->url();
            //--Seo
        }
        

        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name)->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('meta_canonical', $meta_canonical)->with('slider', $slider)->with('category_post', $category_post);
    }
    

    public function export_csv(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }

    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';
        $product = Product::where('category_id', $data['cate_id'])->orderBy('product_id', 'desc')->get();

        $product_count = $product->count();
        if($product_count>0){
            $output = '
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tshirt" >
                ';
                foreach($product as $key => $val){
                    $output.='
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="'.url('public/uploads/product/'.$val->product_image).'" alt="'.$val->product_name.'" />
                                        <h2>'.number_format($val->product_price, 0, ',','.').'<sup>đ</sup></h2>
                                        <p>'.$val->product_name.'</p>
                                        <a href="'.url('/product-details/'.$val->product_slug).'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                }
            $output.='
                </div>
            </div>
            ';
            
        }else{
            $output.='
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tshirt" >
                    <div class="col-sm-12s">
                        <p style="color: red; text-align: center;">Hiện chưa có sản phẩm trong danh mục này</p>
                    </div>
                </div>
            </div>
            ';
        }
        echo $output;
    }
}
