<?php
/**
 * Created by PhpStorm.
 * User: suhanyu
 * Date: 17/1/14
 * Time: 下午2:42
 */

namespace MyBlog\Services;


use Illuminate\Http\Request;

class PageService extends BaseServices
{
    protected $page;



    /**
     * 生成分页的html
     */
    public function getPageHtml($dataArr,Request $request){
        $curPage = $request->page;
        $html = '';
        if(isset($dataArr['last_page'])){
            for($i=1;$i<$dataArr['last_page'];$i++){
                if($curPage == $i){
                    $html .= '<li class=" active"><a href="javascript:void(0)">'.$i.'</a></li>';
                } else {
                    $html .= '<li class=""><a href="/?page='.$i.'">'.$i.'</a></li>';
                }
            }
        }
        return $html;
    }



}// end of class