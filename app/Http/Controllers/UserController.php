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
}
