<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueUsername;
use App\Rules\UniqueEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(){
        if(User::all() === 1){
            return view('admin/users/index', ['no_user' => true]);
        }else{
            $users = User::paginate(7);
            return view('admin/users/index', ['users' => $users, 'no_user' => false]);
        }

    }

    public function show(User $user){


        return view('admin.users.profile', [
            'user'=>$user,
            'roles' => Role::all(),
        ]);
    }

    public function update(User $user, Request $request){

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash', new UniqueUsername],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', new UniqueEmail],
            'password' => ['required','min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
            'avatar' => ['file'],
        ]);

        // //hashing password
        $validated['password'] = Hash::make($request->password);


        if($request->hasFile('avatar')){
            $validated['avatar'] = $request->avatar->store('images');
        }

        $user->update($validated);

        return back();
    }

    public function attach(Request $request, User $user){
        $user->roles()->attach($request->role);
        return back();
    }

    public function detach(Request $request, User $user){
        $user->roles()->detach($request->role);
        return back();
    }

    public function destroy(User $user, Request $request){
        $user->delete();
        session()->flash('user-deleted', 'User has been deleted');
        return back();
    }
}
