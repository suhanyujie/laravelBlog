<?php

namespace App\Model\Article;

use Illuminate\Database\Eloquent\Model;

class LeaveMessageModel extends Model
{
    public $table = 'blog_message';
    public $fillable = [
        'username','email','message','is_del'
    ];

}# 类-结束
