<?php

namespace App;

use App\BaseModel;

class Comment extends BaseModel
{
    protected $fillable = ['user_id','post_id','content']; //可以注入的字段
    //一对多反向 评论所属文章
    public function post(){
        return $this->belongsTo('App\Post');
    }

    //评论所属用户
    public function user(){
        return $this->belongsTo('App\User');
    }

}
