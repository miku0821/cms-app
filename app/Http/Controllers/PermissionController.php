<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions'=>$permissions]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'permission_name' => 'required|unique:App\Models\Permission,name',
        ]);

        Permission::create([
            'name' => Str::ucfirst($request->permission_name),
            'slug' => Str::slug(Str::lower($request->permission_name), '-')
        ]);

        session()->flash( 'creation-status','The permission was successfully created');

        return back(); 
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission){
        if($permission->id == $request->id && $permission->slug === Str::slug(Str::lower($request->name))){
            session()->flash('edit-status', "No changes has made to the permission name");
            return redirect()->route('permissions.index');
        }else{

            $form = $request->all();
            $validator = Validator::make($form,[
                'name' => ['required', Rule::unique('permissions')->ignore($permission->id)],
                'slug' => ['required', Rule::unique('permissions')->ignore($permission->id)],
            ]);

            if($validator->fails()){
                return redirect()->route('permissions.edit', ['permission' => $permission])
                ->withErrors($validator)
                ->withInput();
            }else{
                $permission->update([
                    'name' => Str::ucfirst($request->name),
                    'slug' => Str::slug(Str::lower($request->name), "-"),
                ]);
            }


        session()->flash('edit-status', "The permission : $permission->name was successfully edited");

        return redirect()->route('permissions.index');
        }
    }

    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('destroy-status', "The permission : $permission->name was successfully deleted");
        return back();
    }
}
