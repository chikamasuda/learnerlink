<?php

namespace App;
use App\User;

use App\Constants\Status;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    // ここから追加
    public $incrementing = false;  // インクリメントIDを無効化
    public $timestamps = false; // update_at, created_at を無効化

    // Relation
    public function like_id()
    {
        return $this->belongsTo('App\User', 'like_id', 'id');
    }

    public function user_id()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
} 