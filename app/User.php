<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','self_introduction', 'sex', 'img_name', 'language','address','image', 'profile_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function like_id()
    {
        return $this->hasMany('App\Reaction', 'like_id', 'id');
    }
    
    public function user_id()
    {
        return $this->hasMany('App\Reaction', 'user_id', 'id');
    }
    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'reactions', 'user_id', 'like_id')->withTimestamps();
    }
    
    public function liked()
    {
        return $this->belongsToMany(User::class, 'reactions', 'like_id', 'user_id')->withTimestamps();
    }
    
    public function like($userId)
    {
        $exist = $this->is_like($userId);
        $its_me = $this->id == $userId;
    
        if($exist || $its_me) {
            return false;
        } else {
            $this->likes()->attach($userId);
            return true;
        }
    }
    
    public function dislike($userId)
    {
        $exist = $this->is_like($userId);
        $its_me = $this->id == $userId;
        
        if($exist || $its_me) {
            $this->likes()->detach($userId);
            return true;
        } else {
            return false;
        }
    }    
    
     public function is_like($userId)
    {
     return $this->likes()->where('like_id', $userId)->exists();
    }
    
    public function chatMessages()
    {
        return $this->hasMany('App\ChatMessage');
    }
    
    public function chatRoomUsers()
    {
        return $this->hasMany('App\ChatRoomUsers');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
