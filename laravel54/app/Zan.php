<?php

namespace App;

use App\BaseModel;

class Zan extends BaseModel
{
    protected $fillable = ['user_id','post_id']; //可以注入的字段

}
