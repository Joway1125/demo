<?php


namespace app\admin\controller\v1;


use think\Controller;
use think\Loader;
use think\Request;
use think\Validate;
use app\admin\model\User;

class Login
{
    /*
     * 注册
     * */
    public function register(){
        $user_info = input('post.');
        $validate = Validate('Register');

        if (!$validate->scene('add')->check($user_info)) {
             return returnJson(getMsg($validate->getError()),$validate->getError());
        }
        $user_info['password'] = md5($user_info['password'].config('salt.value'));
        $user = new User();
        $result = $user->allowField(true)->save($user_info);

        if($result){
            return returnJson(200);
        } else {
            return returnJson(10006);
        }
    }

    public function login(){
        $user_info = input('post.');
        $validate = Validate('Login');
        if (!$validate->check($user_info)) {
            return returnJson(getMsg($validate->getError()),$validate->getError());
        }
        $result = User::where('username',$user_info['username'])->find();
        if(md5($user_info['password'].config('salt.value')) != $result['password']){
            return returnJson(10008);
        }
        if($result){
            cache('token',signToken($result['id'],$result['username']));
            $uid = $result['id'];
            $username = $result['username'];
            return returnJson(200,['uid'=>$uid,'username'=>$username]);
        } else {
            return returnJson(10007);
        }
    }

}