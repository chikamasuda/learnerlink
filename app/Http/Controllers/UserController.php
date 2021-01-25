<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use App\Reaction;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findorFail($id);

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(ProfileRequest $request)
    { 
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->language = $request->language;
        $user->address = $request->address;
        $user->self_introduction = $request->self_introduction;

        if($request->image !=null) {
            $user->image = base64_encode(file_get_contents($request->image));
        }
        
        $user->save();

        return redirect('home');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }

    public function index()
    {
        $got_reaction_ids = Reaction::where([
            ['like_id', Auth::id()], //like_idがログイン中のユーザーIDになる
        ])->pluck('user_id');

        $like_users = User::whereIn('id', $got_reaction_ids)->get();
        $like_users_count = count($like_users);
        return view('users.index', compact('like_users', 'like_users_count'));
    }

    public function search(Request $request) 
    {
        $keyword = $request->input('keyword');

        if(!empty($keyword)){
            $query = User::query();
            $users = $query->where('name', 'like', '%' .$keyword. '%')->orwhere('address', 'like', '%' .$keyword. '%')->orwhere('language', 'like', '%' .$keyword. '%')->orwhere('self_introduction', 'like', '%' .$keyword. '%')->orwhere('sex', 'like', '%' .$keyword. '%')->get();
            $users = $query->paginate(12); 
            return view('users.search')->with('users',$users);
        } 

        else {
            $users = null;
            $message = "検索結果はありません";
            return view('users.search')->with([
                'message' => $message,
            ]);
        }
    }
}
