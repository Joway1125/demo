<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------


// 应用公共文件
function getMsg($code){
    $info = config('messages.');
    return (array_key_exists($code,$info)) ? $info[$code] : '操作失败';
}

function returnJson($code = 200,$data=[]){
    return json([
        'code' => $code,
        'msg' => getMsg($code),
        'data' => $data,
        'token' => cache('token')
    ]);
}

/*
 *获取token
 *
 */
function signToken($user_id,$user_name){
    $key = config('salt.token_salt');      //这里是自定义的一个随机字串，应该写在config文件中的，解密时也会用，相当于加密中常用的 盐  salt
    $jwtInfo = array(
        "user_id"=>$user_id,    //签发者 可以为空
        "user_name"=>$user_name,     //面象的用户，可以为空
        "iat"=>time(),  //签发时间
        "nbf"=>time()+1,    //在什么时候jwt开始生效  （这里表示生成1秒后才生效）
        "exp"=> time()+604800,  //token 过期时间,这里表示一个星期（60*60*24*7）=604800
    );
    $token = \Firebase\JWT\JWT::encode($jwtInfo, $key);
    return $token;
}
/*
 *验证token
 *
 */
function checkToken($token){
    $key = config('salt.token_salt');
    try {
        $userinfo = \Firebase\JWT\JWT::decode($token, $key, array('HS256'));
        return $userinfo;
    }
    catch (Exception $e){
        return false;
    }
}

/*
 * 无限极生成树
 */
function generateTree($items){
    $tree = array();
    foreach($items as $item){
        if(isset($items[$item['pid']])){
            $items[$item['pid']]['son'][] = &$items[$item['id']];
        }else{
            $tree[] = &$items[$item['id']];
        }
    }
    return $tree;
}
