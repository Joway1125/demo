<?php


namespace app\admin\controller\v1;


use Firebase\JWT\JWT;
use think\Controller;
use think\Exception;
use think\facade\Request;

class BaseController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
        self::checkToken();
    }

    /*
     * 验证token
     */

    private function checkToken()
    {
        $header = Request::instance()->header();
        if(isset($header['authorization'])){
            if($header['authorization'] != null){
                return $this->verifyJwt($header['authorization']);
            } else {
                return returnJson(10014);
            }
        } else {
            return returnJson(10013);
        }

    }

    /*
     * 校验jwt权限
     */
    private function verifyJwt($jwt){
        $key = config('salt.token_salt');
        try {
            $jwtAuth  = json_decode(JWT::decode($jwt,$key,array('HS256')));
            $authInfo = json_encode($jwtAuth,true);
            if(isset($authInfo['uid']) && !empty($authInfo)){
                return returnJson(10015);
            }
            return returnJson(10016);
        }catch (\Firebase\JWT\SignatureInvalidException $e) {
            return returnJson(10014);
        } catch (\Firebase\JWT\ExpiredException $e) {
            return returnJson(10017);
        } catch (Exception $e) {
            return $e;
        }
    }


}