@extends('index')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="login-form"><!--login form-->
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {!! Session::get('message') !!}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger">
                            {!! Session::get('error') !!}
                        </div>
                    @endif
                    <h2 style="font-size: 20px; font-weight: 500">Đăng nhập</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="email_account" class="form-control" placeholder="Tài khoản" />
                        <input type="password" name="password_account" class="form-control" placeholder="Mật khẩu" />
                        
                        <span>
                            <a href="{{url('/forgot-password')}}">Quên mật khẩu</a>
                        </span>
                        <button type="submit" class="btn btn-default">Đăng Nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-7">
                <div class="signup-form"><!--sign up form-->
                    <h2 style="font-size: 20px; font-weight: 500">Đăng ký tài khoản</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="customer_name" class="form-control" placeholder="Họ và Tên"/>
                        <input type="email" name="customer_email" class="form-control" placeholder="Địa chỉ Email"/>
                        <input type="password" name="customer_password" class="form-control"  placeholder="Mật khẩu"/>
                        <input type="password" name="customer_confirm_password" class="form-control"  placeholder="Nhập lại mật khẩu"/>
                        <input type="text" name="customer_phone" class="form-control" placeholder="Số điện thoại"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection