<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Login;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Social;
use App\Rules\Captcha;
use Dotenv\Validator;
session_start();

class AdminController extends Controller
{
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
    public function callback_google(){
        $users = Socialite::driver('google')->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = Login::where('admin_id',$authUser->user)->first();
        session()->put('admin_name',$account_name->admin_name);
        session()->put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }

    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
      
        $data = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
        $data->login()->associate($orang);
        $data->save();

        $account_name = Login::where('admin_id',$data->user)->first();
        session()->put('admin_name',$account_name->admin_name);
        session()->put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');

    }

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect(); //link của fb nếu chưa đăng nhập thì trả về đăng facebook
    }

    public function callback_facebook(){ //gọi về admin
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first(); //lấy id để so sánh
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            session()->put('admin_name',$account_name->admin_name);
            session()->put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $data = new Social([ //mới đăng nhập lần đầu
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',

                ]);
            }
            $data->login()->associate($orang);
            $data->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            session()->put('admin_name',$account_name->admin_name);
            session()->put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }


    public function AuthLogin(){
        $admin_id = session()->get('admin_id'); //có admin_id login
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
        // $data = $request->all();

        $data = $request->validate([
            //validation laravel
            'admin_email' => 'required|email',
            'admin_password' => 'required|string',
            'g-recaptcha-response' => new Captcha(), 		//dòng kiểm tra Captcha
        ]);
 
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        $login_count = $login->count();
        if($login){
            if($login_count > 0){
                session()->put('admin_name', $login->admin_name);
                session()->put('admin_id', $login->admin_id);
                return Redirect::to('/dashboard');
            }
        } else{
            session()->put('message', 'Sai mật khẩu hoặc tài khoản. Vui lòng xem lại thông tin đăng nhập');
            return Redirect::to('/admin');
        }

        // $admin_email = $request->admin_email;
        // $admin_password = md5($request->admin_password);

        // $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        // if($result){
        //     session()->put('admin_name', $result->admin_name);
        //     session()->put('admin_id', $result->admin_id);
        //     return Redirect::to('/dashboard');
        // } else {
        //     session()->put('message', 'Vui lòng xem lại thông tin đăng nhập');
        //     return Redirect::to('/admin');
        // }
    }

    public function logout(){ 
        $this->AuthLogin();
        session()->put('admin_name', null);
        session()->put('admin_id', null);
        return Redirect::to('/admin');
    }
}
