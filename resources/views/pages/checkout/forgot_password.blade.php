@extends('index')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {!! Session::get('message') !!}
                    </div>
                @elseif(Session::has('error'))
                    <div class="alert alert-danger">
                        {!! Session::get('error') !!}
                    </div>
                @endif
                <div class="login-form"><!--login form-->
                    <h2>Điền email đăng nhập lấy lại mật khẩu</h2>
                    <form action="{{URL::to('/recover-password')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="email_account" placeholder="Nhập email" />
                        
                        <button type="submit" class="btn btn-default">Gửi Mail xác nhận</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection