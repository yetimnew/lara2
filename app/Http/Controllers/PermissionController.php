<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index()
    {
        $permissions = Permission::orderBy('name')->get(); //Get all permissions

        return view('roles.permission.index')->with('permissions', $permissions);
    }

    public function create()
    {
        $roles = Role::get(); //Get all roles

        return view('roles.permission.create')->with('roles', $roles);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permission')
            ->with('flash_message', 'Permission' . $permission->name . ' added!');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('roles.permission.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        //   dd($request->all());
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);


        $permission->name = $request->name;

        $permission->save();


        return redirect()->route('permission')
            ->with('flash_message', 'Permission' . $permission->name . ' updated!');
    }


    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
                ->with('flash_message', 'Cannot delete this Permission!');
        }

        $permission->delete();

        return redirect()->route('permission')
            ->with('flash_message', 'Permission deleted!');
    }
}
