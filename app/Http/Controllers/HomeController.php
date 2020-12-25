<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
   {
      $users = User::all() ;
      $users = User::orderBy('id', 'desc')->paginate(12);
      $user_id = Auth::id(); // 追加
      return view('home', compact('users'));
   }
}