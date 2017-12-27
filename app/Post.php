<?php

namespace App;

use App\Model;
use Laravel\Scout\Searchable;
use PhpParser\Builder;

class Post extends Model
{
    use Searchable;
    public function searchableAs()
    {
        return 'post';
    }
    public function toSearchableArray()
    {
        return[
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }

    //关联用户
    public function user()
    {
        return $this->belongsTo('App\user','user_id','id');
    }
    //评论模型
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
    //用户赞
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    //赞数查询
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }
    //属于某个作者的文章
    public function scopeAuthorBy(Builder $query,$user_id)
    {
        return $query ->where('user_id',$user_id);
    }
    public function postTopics()
    {
        return $this->hasMang(\App\PostTopic::class,'post_id','id');
    }
    //不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query,$topic_id)
    {
        return $query->doesntHave('postTopics','and',function ($q) use ($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }
}
