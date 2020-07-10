<?php

namespace app\admin\model;


use think\Model;

class User extends BaseModel {

    protected $readonly = ['user_name'];
    protected $hidden = ['password','update_time'];
    protected $autoWriteTimestamp = true;

    public function user_info()
    {
        return $this->hasOne('UserInfo','uid','id');
    }
}