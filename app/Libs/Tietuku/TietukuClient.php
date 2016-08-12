<?php
namespace Libs\Tietuku;

use Libs\Tietuku;

/**
 * 贴图库 客户端操作类
 *
 *
 * @package TieTuKu
 * @author Tears
 * @version 1.0
 */
class TietukuClient{

    /**
     * Set up the API root URL.
     *   http://up.imgapi.com/
     * @ignore
     */
    public $upload_host = 'http://up.imgapi.com/'; # "http://up.tietuku.cn/";   http://up.tietuku.cn/

    public $host = "http://kekaoyun.com/v1/";
    /**
     * Set timeout default.
     *
     * @ignore
     */
    public $timeout = 60;
    /**
     * Set CURL timeout.
     *
     * @ignore
     */
    public $CURLtimeout = 60;
    /**
     * 构造函数
     *
     * @access public
     * @param mixed $accesskey 贴图库平台accesskey
     * @param mixed $secretkey 贴图库平台secretkey
     * @return void
     */
    function __construct($accesskey,$secretkey){
        $this->op_Token=new TieTuKuToken($accesskey,$secretkey);
    }
    /**
     * 查询随机30张推荐的图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#list-getrandrec}
     *
     * @access public
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getRandRec($createToken=false){
        $url = $this->host."/List/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getrandrec';
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 根据类型ID查询随机30张推荐的图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#list-getrandrec}
     *
     * @access public
     * @param int $cid 类型ID。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getRandRecByCid($cid,$createToken=false){
        $url = $this->host."/List/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getrandrec';
        $param['cid'] = $cid;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 根据 图片ID 查询相应的图片详细信息
     *
     * 对应API：{@link http://open.tietuku.cn/doc#pic-getonepic}
     *
     * @access public
     * @param int $id 图片ID。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getOnePicById($id,$createToken=false){
        $url = $this->host."/Pic/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getonepic';
        $param['id'] = $id;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 根据 图片find_url 查询相应的图片详细信息
     *
     * 对应API：{@link http://open.tietuku.cn/doc#pic-getonepic}
     *
     * @access public
     * @param string $find_url 图片find_url
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getOnePicByFind_url($find_url,$createToken=false){
        $url = $this->host."/Pic/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getonepic';
        $param['findurl'] = $find_url;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 分页查询全部图片列表 每页30张图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#list-getnewpic}
     *
     * @access public
     * @param int $page_no 页数，默认为1。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getNewPic($page_no=1,$createToken=false){
        $url = $this->host."/List/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getnewpic';
        $param['page_no'] = $page_no;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 通过类型ID分页查询全部图片列表 每页30张图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#list-getnewpic}
     *
     * @access public
     * @param int $cid 类型ID。
     * @param int $page_no 页数，默认为1。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getNewPicByCid($cid,$page_no=1,$createToken=false){
        $url = $this->host."/List/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getnewpic';
        $param['cid'] = $cid;
        $param['page_no'] = $page_no;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 根据用户ID查询用户相册列表
     *
     * 对应API：{@link http://open.tietuku.cn/doc#album-get}
     *
     * @access public
     * @param int $uid 用户ID
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getAlbumByUid($uid=null,$createToken=false){
        $url = $this->host."/Album/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'get';
        if (!empty($uid)) $param['uid'] = $uid;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 查询自己收藏的图片列表
     *
     * 对应API：{@link http://open.tietuku.cn/doc#collect-getlovepic}
     *
     * @access public
     * @param int $page_no 页数，默认为1。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getLovePic($page_no=1,$createToken=false){
        $url = $this->host."/Collect/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getlovepic';
        $param['page_no'] = $page_no;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 通过图片ID喜欢(收藏)图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#collect-addcollect}
     *
     * @access public
     * @param int $id 图片ID。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function addCollect($id,$createToken=false){
        $url = $this->host."/Collect/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'addcollect';
        $param['id']=$id;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 通过图片ID取消喜欢(取消收藏)图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#collect-delcollect}
     *
     * @access public
     * @param int $id 图片ID。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function delCollect($id,$createToken=false){
        $url = $this->host."/Collect/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'delcollect';
        $param['id']=$id;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 通过相册ID分页查询相册中的图片 每页30张图片
     *
     * 对应API：{@link http://open.tietuku.cn/doc#list-album}
     *
     * @access public
     * @param int $aid 相册ID。
     * @param int $page_no 页数，默认为1。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */

    function getAlbumPicByAid($aid,$page_no=1,$createToken=false){
        $url = $this->host."/List/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'album';
        $param['aid'] = $aid;
        $param['page_no'] = $page_no;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 查询所有的分类
     *
     * 对应API：{@link http://open.tietuku.cn/doc#catalog-getall}
     *
     * @access public
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getCatalog($createToken=false){
        $url = $this->host."/Catalog/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getall';
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 创建相册
     *
     * 对应API：{@link http://open.tietuku.cn/doc#album-create}
     *
     * @access public
     * @param string $albumname 相册名称。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function createAlbum($albumname,$createToken=false){
        $url = $this->host."/Album/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'create';
        $param['albumname'] = $albumname;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 编辑相册
     *
     * 对应API：{@link http://open.tietuku.cn/doc#album-editalbum}
     *
     * @access public
     * @param int $aid 相册ID。
     * @param string $albumname 相册名称。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function editAlbum($aid,$albumname,$createToken=false){
        $url = $this->host."/Album/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'editalbum';
        $param['aid'] = $aid;
        $param['albumname'] = $albumname;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 通过相册ID删除相册(只能删除自己的相册 如果只有一个相册，不能删除)
     *
     * 对应API：{@link http://open.tietuku.cn/doc#album-delalbum}
     *
     * @access public
     * @param int $aid 相册ID。
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function delAlbum($aid,$createToken=false){
        $url = $this->host."/Album/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'delalbum';
        $param['aid'] = $aid;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 通过一组图片ID 查询图片信息
     *
     * 对应API：{@link http://open.tietuku.cn/doc#list-getpicbyids}
     *
     * @access public
     * @param mix $ids 图片ID数组。(1.多个ID用逗号隔开 2.传入数组)
     * @param boolean $createToken 是否只返回Token，默认为false。
     * @return string 如果$createToken=true 返回请求接口的json数据否则只返回Token
     */
    function getPicByIds($ids,$createToken=false){
        $stringid='';
        if(is_array($ids)){
            foreach ($ids as $k => $v) {
                $stringid.=$v.',';
            }
            $stringid=substr($stringid,0,-1);
        }else{
            $stringid=$ids;
        }
        $url = $this->host."/List/";
        $param['deadline'] = time()+$this->timeout;
        $param['action'] = 'getpicbyids';
        $param['ids'] = $stringid;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        return $createToken?$Token:$this->post($url,$data);
    }
    /**
     * 上传单个文件到贴图库
     *
     * 对应API：{@link http://open.tietuku.cn/doc#upload}
     *
     * @access public
     * @param int $aid 相册ID
     * @param array $file 上传的文件。
     * @return string 如果$file!=null 返回请求接口的json数据否则只返回Token
     */
    function uploadFile($aid,$file=null){
        $url = $this->upload_host;
        $param['deadline'] = time()+$this->timeout;
        $param['album'] = $aid;
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        //$data['file'] = new CURLFile(realpath($file)); //  phpV<5.5使用'@'.$file  phpV>5.6使用 new CURLFile
        if (class_exists('\CURLFile')) {
            $data['file'] = new \CURLFile(realpath($file));
        } else {
            $data['file'] = '@' . $file;
        }
        return empty($data['file']) ? exit('上传到"贴图库"失败了~') : $this->post($url,$data);
    }
    /**
     * 上传多个文件到贴图库
     *
     * 对应API：{@link http://open.tietuku.cn/doc#upload}
     *
     * @access public
     * @param int $aid 相册ID
     * @param string $filename 文件域名字
     * @return mixed 返回请求接口的json 如果文件域不存在文件则返回NULL
     */
    function curlUpFile($aid,$filename){
        if(is_array($_FILES[$filename]['tmp_name'])){
            foreach ($_FILES[$filename]['tmp_name'] as $k => $v) {
                if(!empty($v)){
                    $res[]=json_decode($this->uploadFile($aid,$v));
                }
            }
        }else{
            $res=json_decode($this->uploadFile($aid,$_FILES[$filename]['tmp_name']));
        }
        return json_encode($res);
    }
    /**
     * 上传网络文件到贴图库 (只支持单个连接)
     *
     * 对应API：{@link http://open.tietuku.cn/doc#upload-url}
     *
     * @access public
     * @param int $aid 相册ID
     * @param string $fileurl 网络图片地址
     * @return string 如果$fileurl!=null 返回请求接口的json数据否则只返回Token
     */
    function uploadFromWeb($aid,$fileurl=null){
        $url = $this->upload_host;
        $param['deadline'] = time()+$this->timeout;
        $param['aid'] = $aid;
        $param['from'] = 'web';
        $Token=$this->op_Token->dealParam($param)->createToken();
        $data['Token']=$Token;
        $data['fileurl']=$fileurl;

        return empty($url)?$Token:$this->post($url,$data);
    }
    /**
     * 对接口post数据
     *
     *
     * @access public
     * @param string $url 接口请求地址。
     * @param array $data 需要post的数据
     * @return string 返回的json数据
     */
    function post($url,$post_data){
        //var_dump($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT,100);  # $this->CURLtimeout
        //curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8");
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


}# 类-结束