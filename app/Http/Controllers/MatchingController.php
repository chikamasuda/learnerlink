<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reaction;
use App\User;
use Auth;


class MatchingController extends Controller
{
    public static function index() {
        $got_reaction_ids = Reaction::where([
            ['like_id', Auth::id()], //like_idがログイン中のユーザーIDになる
            ])->pluck('user_id');
            
        $matching_ids = Reaction::whereIn('like_id', $got_reaction_ids)
        ->where('user_id', Auth::id())
        ->pluck('like_id');
        
        $matching_users = User::whereIn('id', $matching_ids)->get();
        $match_users_count = count($matching_users);
        return view('users.matching', compact('matching_users', 'match_users_count'));
    }

}
