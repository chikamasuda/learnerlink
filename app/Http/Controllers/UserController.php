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
    
    public function update($id, ProfileRequest $request)
    {
        $user = User::findorFail($id);
        
        // if ($request->user_profile_photo !=null) {
        //     $request->user_profile_photo->storeAs('public/images', $user->id . '.jpg');
        //     $user->profile_photo = $user->id . '.jpg';
        // }
        
        if($request->user_profile_photo != null){
            $user->image = base64_encode(file_get_contents($request->user_profile_photo));
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->language = $request->language;
        $user->address = $request->address;
        $user->self_introduction = $request->self_introduction;
        $user->save();
        
        return redirect('/home');
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
        $q = $request->input('q');  //フォームの入力値を取得

        //検索ワードが空の場合
        if (empty($q)) {
            $users = User::paginate(20);
        } else {
            $_q = str_replace('　', ' ', $q);  //全角スペースを半角に変換
            $_q = preg_replace('/\s(?=\s)/', '', $_q); //連続する半角スペースは削除
            $_q = trim($_q); //文字列の先頭と末尾にあるホワイトスペースを削除
            $_q = str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $_q); //円マーク、パーセント、アンダーバーはエスケープ処理
            $keywords = array_unique(explode(' ', $_q)); //キーワードを半角スペースで配列に変換し、重複する値を削除
            
            $query = User::query();
            foreach($keywords as $keyword) {
                $query->where(function($_query) use($keyword){
                    $_query->where('name', 'LIKE', '%' .$keyword. '%')
                           ->orwhere('language', 'LIKE', '%' .$keyword. '%')
                           ->orwhere('addres', 'LIKE', '%' .$keyword. '%')
                           ->orwhere('self_introduction', 'LIKE', '%' .$keyword. '%')
                           ->orwhere('sex', 'LIKE', '%' .$keyword. '%');
                });
            }
            $users = $query->pagenate(20);
        }
        return view('search', compact('users', 'q'));
    }
}
