<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Permission;

class UserController extends Controller
{
    public function list(Request $request){
        $users=User::orderby('id','DESC')
                ->with('permissions')
                ->filter($request->q)
                ->rol($request->rol)
                ->paginate(5);

        $permissions = Permission::all();

        return [
            'pagination' => [
                'total'         => $users->total(),
                'current_page'  => $users->currentPage(),
                'per_page'      => $users->perPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem(),
            ],
            'users' => $users,
            'permissions'=>$permissions
        ];
    }
    public function index()
    {
        return view('users.index');
    }
    public function store(UserRequest $request){
        $user=new User;
        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        $password_created=$request->password;
        $user->password=Hash::make($password_created);
        $user->save();
        $user->syncPermissions($request->permissions);
        return response()->json(['usuario'=>$user->usuario]);

    }
    
    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
