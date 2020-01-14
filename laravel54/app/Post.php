<?php

namespace App;

use App\BaseModel;
//对应表posts
class Post extends BaseModel
{
    //指定数据表
    //protected $table = "posts2";
    protected $fillable = ['title','content','user_id']; //可以注入的字段

    //文章关联用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //一篇文章可以有多个评论 一对多 文章下的评论
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    //文章和赞的关联 和用户进行关联
    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    //对文章赞数进行统计
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }

}
