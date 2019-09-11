<?php

namespace app\api\controller;

use fast\Http;
use think\Controller;
use think\Request;

class Test extends Controller
{
    public function getBaseInfo()
    {
        $appid = 'wx9d1865ea3c06a468';
        $appsecret = '72b6ab9ddfff4641e0c9e8a356a6f06d';
        $redirect_uri = urlencode('http://flower.wlforever.com/api/test/getUserOpenId');
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=111#wechat_redirect';
        header("location:".$url);
    }

    public function getUserOpenId()
    {
        $appid = 'wx9d1865ea3c06a468';
        $appsecret = '72b6ab9ddfff4641e0c9e8a356a6f06d';
        $code = $this->request->param('code');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $res = json_decode(Http::get($url),true);
        $access_token = $res['access_token'];
        $open_id = $res['openid'];

        $url2 = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$open_id.'&lang=zh_CN';
        $userInfo = Http::get($url2);
        dump($userInfo);die;
    }
}
