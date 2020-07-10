<?php


namespace app\admin\validate;


use think\Validate;

class Register extends  Validate
{
    protected $rule = [
        'username'  =>  'require|max:25',
        'password' =>  'require|min:6',
    ];

    protected $message = [
        'username.require' => 10002,
        'username.max'     => 10003,
        'password'     => 10004,
    ];

    protected function checkUserInfo($value)
    {
        $validate = new Validate($this->rule);
        $result = $validate->check($value);
        if(!$result){
            return false;
        }
    }
}