<?php


namespace app\admin\validate;


use think\Validate;

class Auth extends Validate
{
    protected $rule = [
        'auth_name' => 'require|max:25',
        'pid' =>  'require',
        'auth_a' =>  'require',
        'auth_c' =>  'require',
        'auth_level' =>  'require',
    ];

    protected $message = [
        'auth_name.require' => 10009,
        'auth_name.max'     => 10012,
        'auth_a'            => 10010,
        'auth_c'            => 10011,
    ];

    protected function checkAuthInfo($value)
    {
        $validate = new Validate($this->rule);
        $result = $validate->check($value);
        if(!$result){
            return false;
        }
    }
}