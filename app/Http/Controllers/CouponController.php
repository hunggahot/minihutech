<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function insert_coupon(){
        return view('admin.coupon.insert_coupon');
    }

    public function list_coupon(){
        $coupon = Coupon::orderby('coupon_id', 'desc')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }

    public function insert_coupon_code(Request $request){
        $data = $request->all();

        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_times = $data['coupon_times'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();

        session()->put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');
    }
}
