<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\UserRequestUpdate;
use Caffeinated\Shinobi\Models\Permission;

class UserController extends Controller
{
    public function list(Request $request){
        $users=User::orderby('id','DESC')
                ->with('permissions','roles')
                ->rol($request->rol)
                ->paginate(5);

        $permissions = Permission::all();
        $roles = Role::all();

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
            'permissions'=>$permissions,
            'roles' => $roles,
        ];
    }
    public function index()
    {
        return view('Users.index');
    }
    public function store(UserRequest $request){
        $user=new User;
        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        $password_created=$request->password;
        $user->password=Hash::make($password_created);
        $user->save();
        if($request->role){
            $user->syncRoles($request->role);
        }
        $user->syncPermissions($request->permissions);
        //create action
       $user_auth = Auth::user();
        $user_auth->logs()->create([
            'action' => 'created user: ' . $user->name . ' with email: ' . $user->email 
        ]);
        return response()->json(['usuario'=>$user->usuario]);

    }

    public function update(UserRequestUpdate $request, $id){
        //dd($request->all());
        $user=User::findOrFail($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->username=$request->username;

        //create action
        $user_auth = Auth::user();
        $user_auth->logs()->create([
            'action' => 'updated user: ' . $user->name . ' with email: ' . $user->email 
        ]);

        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if($request->role){
            $user->syncRoles($request->role);
        }
        $user->revokePermissionTo($user->permissions);
        if(!empty($request->permissions)){
            $user->removeRoles('admin');
            $user->syncPermissions($request->permissions);
        }
    }

    public function profile($id){

        $user=User::findOrFail($id);

        return view('Users.profile',compact('user'));
    }
    public function updateprofile(Request $request,$id){

        $user=User::findOrFail($id);
        $user->name=$request->name;
        $user->username=$request->username;
        $rules =[
            'name' => 'required|string',
            'username' => 'required|string',
            'currentPassword' => 'nullable|string',
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];

        $this->validate($request,$rules);

        //create action
        $user_auth = Auth::user();
        $user_auth->logs()->create([
            'action' => 'updated profile user: ' . $user->name . ' with email: ' . $user->email 
        ]);

        if(!empty($request->currentPassword)){
            $passwordActual = Hash::make($request->currentPassword);

            if(Hash::check($request->currentPassword, $user->password)){
                if(!empty($request->password)){
                    $user->password = Hash::make($request->password);
                    $user->save();
                    #return back()->with('info','User Updated with success');
                    Auth::logout();
                    return redirect('/login');
                }else{
                    return back()->with('msj','The new password is empty');
                }
            }else{
                return back()->with('msj','The current password is not correct');
            }
        }
        else{
            $user->save();
            return back()->with('info','User Updated with success');
        }


    }
}
