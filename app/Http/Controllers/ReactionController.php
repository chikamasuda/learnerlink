<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Reaction;
use App\Constants\Status;
use Log;

class ReactionController extends Controller
{
    public function store(Request $request, $id)
    {
        \Auth::user()->like($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->dislike($id);
        return back();
    }
}
