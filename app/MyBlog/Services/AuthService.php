<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 2019/4/19
 * Time: 14:18
 */

namespace App\MyBlog\Services;


class AuthService
{
    public function checkIsBot(array $params)
    {
        $options = [
            'score' => 0,
        ];
        $options = array_merge($options, $params);
        if ($options['score'] < 0.2) {
            return ['status'=>3,'msg'=>'您是机器人！'];
        } else if ($options['score']>=0.2 && $options['score'] < 0.6) {
            return ['status'=>2,'msg'=>'您可能是机器人！'];
        }else{
            return ['status'=>1,'msg'=>'机器人验证通过！'];
        }
    }

    public function resolveRecaptchaV3(array $params)
    {
        $options = [
            'secret'   => '',// required. The shared key between your site and reCAPTCHA.
            'response' => '',// required.  The user response token provided by the reCAPTCHA client-side integration on your site.
            'remoteip' => '',// optional. The user's IP address.
        ];
        $options = array_merge($options, $params);
        $result = HttpRequestService::curlHttp([
            'url'      => 'https://www.google.com/recaptcha/api/siteverify',// string 请求的url
            'method'   => 'post',// string 请求类型
            'postData' => [
                'secret'   => $options['secret'],
                'response' => $options['response'],
                'remoteip' => $options['remoteip'],
            ],// array 数组类型
            'bodyType' => 1,
        ]);
        if ($result['status'] != 1) {
            throw new \Exception("请求谷歌机器人验证异常：[{$result['msg']}]", 400);
        }
        $responseJson = $result['data'];
        $responsArr = json_decode($responseJson, true);
        if ($responsArr['success'] !== true) {
            throw new \Exception(implode("\n", $responsArr['error-codes']), 401);
        }

        return ['status'=>1, 'msg'=>'验证完成！','data'=>$responsArr,];
    }
}
