<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 2019/4/16
 * Time: 13:27
 */

namespace App\Service\Article;


class MysqlToolService
{
    /**
     * 博客数据库备份
     */
    public static function backup()
    {
        $command    = '/usr/local/mysql/bin/mysqldump -h 127.0.0.1 -u root --password="' . env('DB_PASSWORD','') . '" '."\"laravel\"".' > /data/backup/laravel_' . date('YmdHis') . '.bk';
        exec($command, $return);
        $retString = "";
        if (is_array($return)) {
            $retString = implode("\n", $return);
        }
        echo "备份命令返回的内容如下：\n".$retString."\n";
        exec('ls -alh /data/backup',$return);
        if (is_array($return)) {
            $retString = implode("\n", $return);
        }
        echo "备份目录下的文件列表：\n";
        echo $retString."\n";
        echo '备份成功! <a href="/"> 回到首页 </a>'."\n";
    }
}
