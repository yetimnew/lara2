<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }


    public function index()
    {
        $users = User::all();
        $permissions = Permission::all();

        return view('users.index')->with('users', $users)->with('permissions', $permissions);
    }


    public function create()
    {
        $roles = Role::get();
        $permissions = Permission::all();
        return view('users.create')
            ->with('permissions', $permissions)
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  bcrypt($request->password);

        $user->save();

        // $user = User::create($request->only('email', 'name', $bcrypt)); //Retrieving only the email and password data
        $roles = $request['roles']; //Retrieving the roles field//Checking if a role was selected
        $permissions = $request['permissions']; //Retrieving the roles field//Checking if a role was selected

        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        if (isset($permissions)) {

            foreach ($permissions as $permission) {
                $role_r = Permission::where('id', '=', $permission)->firstOrFail();
                $user->givePermissionTo($role_r); //Assigning role to user
            }
        }

        Profile::create([
            'user_id' => $user->id,
            'image' => 'uploads/avatar.jpg',
            'about' => 'fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff',

        ]);

        return redirect()->route('user')
            ->with('flash_message', 'User successfully added.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::orderBy('name')->get(); //Get all permissions
        $roles = Role::all();
        return view('users.edit')
            ->with('user', $user)
            ->with('permissions', $permissions)
            ->with('roles', $roles);
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id); //Get role specified by id
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
            // 'password'=>'required|min:6|confirmed'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password =  bcrypt($request->password);
        $user->save();

        $roles = $request['role']; //Retrieving the roles field//Checking if a role was selected
        $permissions = $request['permission']; //Retrieving the roles field//Checking if a role was selected



        if (isset($roles)) {
            $roll_all = role::all(); //Get all role

            foreach ($roll_all as $p) {
                $user->removeRole($p); //Remove all permissions associated with role
            }

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        if (isset($permissions)) {

            $per_all = Permission::all(); //Get all role
            foreach ($per_all as $p) {

                $user->revokePermissionTo($p); //Remove all permissions associated with role
            }

            foreach ($permissions as $permission) {
                $permission_r = Permission::where('id', '=', $permission)->firstOrFail();
                $user->givePermissionTo($permission_r); //Assigning role to user
            }
        }

        Session::flash('success', 'User Updated successfuly');
        return redirect()->route('user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // $user->active = 0;
        $user->delete();
        Session::flash('success', 'User ' . $user->name . ' successfully deleted');
        return redirect()->back();
    }
}
