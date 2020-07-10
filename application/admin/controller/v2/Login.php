<?php


namespace app\admin\controller\v2;


use app\admin\controller\ReturnResponse;
use think\Controller;
use think\Request;

class Login extends Controller
{
    /*
     * 注册
     * */
    public function register(){
        $user_info = input('post.');
        if($user_info.password !== $user_info.check_password){
            return returnJson(getMsg(10001),10001);
        }
    }


}