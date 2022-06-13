<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id'); //có admin_id login
        if($admin_id){
            return Redirect::to('dashboard');
        } else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){ //login function
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            session()->put('admin_name', $result->admin_name);
            session()->put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            session()->put('message', 'Vui lòng xem lại thông tin đăng nhập');
            return Redirect::to('/admin');
        }
    }

    public function logout(){ 
        $this->AuthLogin();
        session()->put('admin_name', null);
        session()->put('admin_id', null);
        return Redirect::to('/admin');
    }
}
