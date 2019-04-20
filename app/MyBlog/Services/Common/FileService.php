<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 2019/4/20
 * Time: 12:47
 */

namespace App\MyBlog\Services\Common;

use App\MyBlog\Services\HttpRequestService;
use MyBlog\Services\BaseServices;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * 文件的处理类
 * Class FileService
 * @package App\MyBlog\Services\Common
 */
class FileService extends BaseServices
{
    public function uploadFile(array $params)
    {
        $options = [
            'file'     => '',
            'typeCode' => 1,
        ];
        $options = array_merge($options, $params);
        $file = $options['file'];
        if (!($file instanceof UploadedFile)) {
            return ['status'=>199,'message'=>'文件对象不合法！'];
        }
        // 文件是否上传成功
        if ($file->isValid()) {
            $ext = $file->getClientOriginalExtension();// 扩展名
            $type = $file->getClientMimeType();
            $fileInfoArr = [
                'tmp_name' => $file->getPath(),// 临时文件的存储路径
                'tmp_path'=>$file->getRealPath(),
                'type'     => $file->getClientMimeType(), // image/jpeg
                'size'     => $file->getClientSize(),// 大小
            ];
            if (strlen($fileInfoArr['type']) > 20) {
                $infoArr = pathinfo($fileInfoArr['tmp_name']);
                $type = $fileInfoArr['type'] = 'application/' . $infoArr['extension'];
            }
            $checkResult = self::checkFileTypeAllow([
                'typeCode' => $options['typeCode'],
                'type'     => $type,
            ]);
            if ($checkResult['status'] != 1) {
                return ['status'=>21,'message'=>$checkResult['message']];
            }
            // 上传文件
//            $str = str_replace('.','',microtime(true).uniqid());
//            if (!empty($options['objectForced'])) {
//                $filename = $options['objectForced'];
//            } else {
//                $filename = date('Y-m-d') . '/' . date('YmdHis') . '-' . $str . '.' . $ext;
//            }
            $uploadUrl = env('FILE_UPLOAD_API', '');
            if (empty($uploadUrl)) {
                return ['status'=>211, 'message'=>'上传接口为空！'];
            }
            $result = HttpRequestService::curlHttp([
                'url'          => $uploadUrl,// string 请求的url
                'method'       => 'post',// string 请求类型
                'postData'     => [
                    'file' => new \CURLFile($fileInfoArr['tmp_path']),
                ],// array 数组类型
                'bodyType'     => 21,
                'timeout'      => 10,
                'addHeaderArr' => [
                    'Content-type:multipart/form-data;',
                    'Referer: https://share1223.com/free.html',
                ],
            ]);
            if ($result['status'] != 1) {
                return $result;
            }
            // $result['data']中的信息为:
            // {"code":1,"msg":"操作成功","data":{"code":"200","width":1024,"height":768,"size":205857,"pid":"005BYqpgly1g291ce3b9vj30sg0lckc7","url":"https:\/\/ws3.sinaimg.cn\/large\/005BYqpgly1g291ce3b9vj30sg0lckc7.jpg"},"runtime":"3.831245s"}
            $response = $result['data'];
            $responseArr = json_decode($response, true);
            if ($responseArr['code'] != 1) {
                return ['status'=>212, 'message'=>$responseArr['msg'],];
            }
            if ($responseArr['data']['code'] != 200) {
                return ['status'=>213, 'message'=>$responseArr['data']['msg'],];
            }
            $imgUrl = stripslashes($responseArr['data']['url']);

            return ['status'=>1, 'data'=>$imgUrl, 'linkurl'=>$imgUrl];
        } else {
            return ['status'=>10000,'message'=>'文件不合法！'.$file->getClientMimeType(),'data'=>''];
        }
    }

    //检查图片的大小
    public static function checkSize(UploadedFile $file)
    {
        $size = $file->getSize();
        // 1MB
        if ($size > 1*1024*1024) {
            return ['status'=>2, 'message'=>'文件不能大于1MB'];
        }

        return ['status'=>1, 'message'=>'文件大小合格'];
    }

    /**
     * @desc 检查对应的文件类型是否合法
     * @param array $paramArr
     * @return array
     */
    public static function checkFileTypeAllow($paramArr=[])
    {
        $options = [
            'typeCode' => '',// 文件类型的代码 按照下面switch定义的
            'type'     => '',// 资源的类型名
        ];
        $options = array_merge($options, $paramArr);
        switch ($options['typeCode']) {
            case 1:// 图片
                if (!in_array($options['type'], ['image/png', 'image/jpg', 'image/jpeg',])) {
                    return ['status' => 3, 'message' => '请上传正确的图片文件'];
                }
                break;
            case 2:// pdf
                if ($options['type'] != 'application/pdf') {
                    return ['status' => 31, 'message' => '请上传正确的pdf文件'];
                }
                break;
            case 4://excel office文件
                if (!in_array($options['type'], ['application/xlsx',
                    'application/docx',])) {
                    return ['status' => 26600, 'message' => '请上传正确的excel-office文件'];
                }
                break;
            default:
                return ['status' => 4, 'message' => '文件类型未知'];
        }

        return ['status'=>1, 'message'=>'文件检查通过，类型合法'];
    }
}
