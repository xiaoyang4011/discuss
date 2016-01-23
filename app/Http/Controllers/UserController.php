<?php
/**
 * Created by PhpStorm.
 * User: liuxiaoyang
 * Date: 15/11/14
 * Time: 上午10:14
 */

namespace App\Http\Controllers;

use App\Models\RegisterCode;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Log;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Controllers\Controller;
use Hyancat\Sendcloud\SendCloudFacade as SendCloud;
use Hyancat\Sendcloud\SendCloudMessage as SendCloudMessage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * 登陆
     */
    public function login(UserLoginRequest $request){
        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'is_confirm' => 1,
        ])) {
            return redirect('/');
        }

        Session::flash('user_login_failed', '密码不正确或邮箱尚未验证');

        return redirect('/login')->withInput();
    }

    /**
     * 生成注册码
     */
    public function make_register_code(){
        $register_code = [
            'status'=> 0,
            'register_code' => md5(str_random(10)),
            'use_user_id' => 0,
        ];

        RegisterCode::create($register_code);

        return redirect('/register_code_list');
    }

    /**
     * 获取注册码列表
     */
    public function register_code_list(){
        $code_list = RegisterCode::all();

        return view('auth.code_list')->with('code_list', $code_list);
    }

    /**
     * 注册
     */
    public function do_register(UserRegisterRequest $request) {

        $code_result = RegisterCode::where('register_code', $request->get('register_code'))
                       ->where('status', '0')->first();

        if(count($code_result) == 0){
            return redirect('/register');
        }

        $register_data = [
            'name'         => $request->get('name'),
            'email'        => $request->get('email'),
            'password'     => Hash::make($request->get('password')),
            'avatar'       => '/images/default-avatar.png',
            'confirm_code' => str_random(48),
        ];

        //写入用户
        $save_user_result = User::create($register_data);

        //更新注册码的状态
        $code_result->status = 1;
        $code_result->use_user_id = $save_user_result->getAttribute('id');
        $code_result->save();

        //给用户发送邮件
        $email = $save_user_result->getAttribute('email');
        $confirm_code = $save_user_result->getAttribute('confirm_code');

        SendCloud::sendTemplate(
            'test_template_active',
            ['%url%'=> ['http://localhost:8000/confirm_register?confirm_code='.$confirm_code.'&email='.$email]],
            function (SendCloudMessage $message) use ($email)  {
            $message->to([$email])->subject('7csa激活注册信息');
        })->success(function ($response)  use ($email){
        })->failure(function ($response, $error) {
            Log::info('注册发送邮件失败:'.$response);
        });

        return redirect('/send_confirm_mail');
    }

    public function setPasswordAttribute($password){

        $this->attributes['password'] = \Hash::make($password);
    }

    public function send_confirm_mail(){

        return view('auth.confirm_mail');
    }

    public function confirm_register(Request $request){
        $user_info =User::where('email', $request->get('email'))
            ->where('confirm_code', $request->get('confirm_code'))->first();

        if($user_info == null){
            return redirect('/')->with('msg', '激活连接失效,请联系管理员');
        }else{
            $user_info->confirm_code = str_random(48);
            $user_info->is_confirm = 1;
            $user_info->save();

            return view('success')->with('msg', '激活成功');
        }
    }

    public function avatar(){

        return view('auth.avatar');
    }

    public function change_avatar(Request $request){

        $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );

        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }
        $destinationPath = 'uploads/avatar/';
        $filename = \Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath.$filename)->fit(400)->save();

        return \Response::json(
            [
                'success' => true,
                'avatar' => '/'.$destinationPath.$filename
            ]
        );
    }

    public function crop_avatar(Request $request){
        $photo = mb_substr($request->get('photo'),1);
        $width = (int)$request->get('w');
        $height = (int)$request->get('h');
        $xAlign = (int)$request->get('x');
        $yAlign = (int)$request->get('y');

        Image::make($photo)->crop($width, $height, $xAlign, $yAlign)->save();

        $user = \Auth::user();

        $user->avatar = $request->get('photo');

        $user->save();

        return redirect('/avatar');
    }
}