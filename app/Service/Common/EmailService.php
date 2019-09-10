<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 2019-09-08
 * Time: 11:37
 */

namespace App\Service\Common;


use App\Service\BaseService;
use function foo\func;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EmailService extends BaseService
{

    /**
     * @desc 测试发送邮件
     */
    public function sendEmail()
    {
        $title = "发送测试邮件";
        $data  = [
            'name' => $title,
        ];
        Mail::send('common.email.template1', $data, function ($message) {
            $to = "suhanyujie@126.com";
            $message->to($to)->subject('测试邮件');
        });
        return $retMsg = json_encode(Mail::failures(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }


    /**
     * @desc 新增订阅
     */
    public function addSub()
    {
        $this->getRedis();
    }


    /**
     * @desc
     */
    public function getRedis()
    {
        $redisClient = Redis::connection('test1');
        $subUserArr = ['user1', 'user2', 'user3'];
        // 查询出那些用户订阅了该频道
        Redis::subscribe('test_channel', function ($message) use ($subUserArr) {
            if ($subUserArr) {
                foreach ($subUserArr as $item) {
                    echo "{$item} -> {$message}".PHP_EOL;
                }
            }
        });
    }
}
