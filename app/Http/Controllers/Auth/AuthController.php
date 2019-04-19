<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\MyBlog\Services\AuthService;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    protected $redirectPath = '/';

    protected $loginPath = '';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
        if (basename($request->getUri()) == 'login' && $request->isMethod('post')) {

        }
    }

    public function selfPostLogin(Request $request)
    {
        // 人机识别
        $result = $this->resolveReCAPTCHAV3($request);
        // status为1、2的，大概率不是机器人
        if ($result['status'] != 1 && $result['status'] != 2) {
            $validate = Validator::make([],[])->errors()->add('isValid',"您的身份可能是机器人。{$result['msg']}");
            return back()->withErrors($validate);
        }

        return $this->postLogin($request);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     *  退出登录
     */
    public function logout(){
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect::to('login');
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * 检查是否是机器人
     *  status :
     *      1 正常
     *      2 可能是机器人
     *      其他 是机器人
     * @param Request $request
     * @return array|void
     */
    public function resolveReCAPTCHAV3(Request $request)
    {
        $postData = $request->all();
        $service = new AuthService;
        try {
            $result = $service->resolveRecaptchaV3([
                'secret'   => env('GOOGLE_RECAPTCHA_SECRET',''),// required
                'response' => $postData['token'],// required
            ]);
            if ($result['status'] == 1) {
                $result = $service->checkIsBot($result['data']);
            }
        }catch (\Exception $e) {
            $result = [
                'status'=>$e->getCode(),
                'msg'=>$e->getMessage(),
            ];
        }

        return $result;
    }
}
