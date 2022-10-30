<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_size(){
        $all_size = Size::orderBy('size_id', 'desc')->get();
        return view('admin.size.list_size')->with(compact('all_size'));
    }

    public function add_size(){
        return view('admin.size.add_size');
    }

    public function unactive_size($size_id){
        $this->AuthLogin();
        DB::table('tbl_size')->where('size_id', $size_id)->update(['size_status'=>0]);
        Session::put('message', 'Ẩn size thành công');
        return Redirect::to('manage-size');
    }

    public function active_size($size_id){
        $this->AuthLogin();
        DB::table('tbl_size')->where('size_id', $size_id)->update(['size_status'=>1]);
        Session::put('message', 'Hiển thị Size thành công');
        return Redirect::to('manage-size');
    }

    public function insert_size(Request $request){
        $this->AuthLogin();

        $data = $request->all();
        $size = new Size();
        $size->size_number = $data['size_number'];
        $size->size_status = $data['size_status'];
        $size->save();
        Session::put('message', 'Thêm Size thành công');
        return Redirect::to('add-size');
    }
}
