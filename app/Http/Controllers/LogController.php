<?php

namespace App\Http\Controllers;

use App\Log;
use App\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
   
    public function index()
    {
        $users = User::with('permissions','roles','logs')
                ->orderby('id','DESC')
                ->paginate(5);
        //dd($users);
        return view('logs.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $logs = $user->logs()->orderby('created_at','desc')->paginate(6);
        //dd($logs);
        return view('logs.show',compact('logs','user'));
    }

}
