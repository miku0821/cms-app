<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', ['roles'=>$roles]);
    }

    public function store(Request $request){
        $request->validate([
            'role_name' => 'required|unique:App\Models\Role,name'
        ]);

        $role = Role::create([
            'name' => Str::ucfirst($request->role_name),
            'slug' => Str::slug(Str::lower($request->role_name), "-"),
        ]);

        session()->flash('create_status', "The role \" $role->name \" was successfully created");

        return back();
    }

    public function edit(Role $role){
        $permissions = Permission::all();
        return view('admin.roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function update(Request $request, Role $role){
        if($role->slug === Str::slug(Str::lower($request->name), "-") && $role->id == $request->id){
            session()->flash('update_status', "No changes has made to the role name");
            return redirect()->route('roles.index');
        }

            $form = $request->all();
            $validator = Validator::make($form,[
                'name' => ['required', Rule::unique('roles')->ignore($role->id)],
            ]);

            if($validator->fails()){
                return redirect()->route('roles.edit', ['role' => $role])
                ->withErrors($validator)
                ->withInput();
            }else{
                $role->update([
                    'name' => Str::ucfirst($request->name),
                    'slug' => Str::slug(Str::lower($request->name), "-"),
                ]);
            }
    
            session()->flash('update_status', "The role \" $role->name \" was successfully updated");

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role){
        $role->delete();

        session()->flash('destroy_status', "The role \" $role->name \" was successfully deleted");

        return back();
    }

    public function attach_permission(Request $request, Role $role){
        $role->permissions()->attach($request->permission);
        return back();
    }

    public function detach_permission(Request $request, Role $role){
        $role->permissions()->detach($request->permission);
        return back();
    }
}
