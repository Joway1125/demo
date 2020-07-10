<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//

Route::post('admin/:version/login', 'admin/:version.Login/login');

Route::post('admin/:version/register', 'admin/:version.Login/register');

Route::post('admin/:version/add_auth', 'admin/:version.Auth/addAuth');

Route::post('admin/:version/index', 'admin/:version.Index/index');
