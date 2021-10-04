<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//Modelです
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function get_userno_microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['get_userno_microposts', 'get_following_users', 'get_followers','get_favorite_microposts']);
    }
    
    public function get_following_users()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    

    
    public function get_followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function check_is_following($targetUserId)
    {
        return $this->get_following_users()->where('follow_id', $targetUserId)->exists();
    }
    
    public function follow($targetUserId)
    {

        $exist = $this->check_is_following($targetUserId);

        $its_me = $this->id == $targetUserId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->get_following_users()->attach($targetUserId);
            return true;
        }
    }

    public function unfollow($targetUserId)
    {

        $exist = $this->check_is_following($targetUserId);
        $its_me = $this->id == $targetUserId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->get_following_users()->detach($targetUserId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    //タイムライン
    public function feed_microposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->get_following_users()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Micropost::whereIn('user_id', $userIds);
    }
    
    //お気に入り
    public function get_favorite_microposts()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
    }
    
    public function check_is_favorite_microposts($targetMicropostId)
    {
        return $this->get_favorite_microposts()->where('micropost_id', $targetMicropostId)->exists();
    }
    
    
     public function addFavorite($targetMicropostId)
    {

        $exist = $this->check_is_favorite_microposts($targetMicropostId);

        $its_me = $this->id == $targetMicropostId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->get_favorite_microposts()->attach($targetMicropostId);
            return true;
        }
    }

    public function delFavorite($targetMicropostId)
    {

        $exist = $this->check_is_favorite_microposts($targetMicropostId);

        $its_me = $this->id == $targetMicropostId;

        if ($exist && !$its_me) {
            $this->get_favorite_microposts()->detach($targetMicropostId);
            return true;
        } else {
            return false;
        }
    }
    
    
}
