<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name','email','password'
    ];
    //用户文章
    public function posts()
    {
        return $this->hasMany(\App\Post::class,'user_id','id');
    }
    //关注我的粉丝
    public function fans()
    {
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }
    //我关注的
    public function stars()
    {
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }
    public function doFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        $this->stars()->save($fan);
    }

    public function doUnFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        $this->stars()->delete($fan);
    }

    //当前用户是否被UID关注
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户是否关注UID
    public function  hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }

    //
}