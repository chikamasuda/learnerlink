<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\User;
use Auth;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
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
        
        $this->validate($request, [
            'name' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'language' => 'required|string|max:15',
            'address' => 'required|string|max:15',
            'self_introduction' => 'required|string|max:255', 
        ]);
        
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
    
    public function search(Request $request) {
        $keyword_name = $request->name;
        $keyword_sex = $request->sex;
        $keyword_language = $request->language;
        $keyword_address = $request->address;
        $name = User::where('name')->get();
       
        if(!empty($keyword_name)){
            $query = User::query();
            $users = $query->where('name', 'like', '%' .$keyword_name. '%')->get();
            return view('/search')->with([
                'users' => $users,

            ]);
        } 
        
        
        elseif(!empty($keyword_language)){
            $query = User::query();
            $users = $query->where('language', 'like', '%' .$keyword_language. '%')->get();
            $message = "言語の検索が完了しました";
            return view('/search')->with([
                'users' => $users,
            ]);
        }
        
        elseif(!empty($keyword_address)){
            $query = User::query();
            $users = $query->where('address', 'like', '%' .$keyword_address. '%')->get();
            $message = "住所の検索が完了しました";
            return view('/search')->with([
                'users' => $users,
            ]);
        }
    
        elseif($keyword_sex == 1){
            
            $query = User::query();
            $users = $query->where('sex', '男性')->get();
            $message = "男性の検索が完了しました";
              return view('/search')->with([
                  'users' => $users,
              ]);
        }
        
        elseif($keyword_sex == 2){
            
            $query = User::query();
            $users = $query->where('sex', '女性')->get();
            $message = "女性の検索が完了しました";
              return view('/search')->with([
                  'users' => $users,
              ]);
        }
        
        else {
            $users = null;
            $message = "検索結果はありません";
            return view('search')->with([
                'message' => $message,
            ]);
        }
    }
}
