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
use Illuminate\Validation\Rule;


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

        // $validated = $request->validate([
        //     'username' => ['required', 'string', 'max:255', 'alpha_dash', ],
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'email', 'max:255'],
        //     'password' => ['required','min:6', 'confirmed'],
        //     'password_confirmation' => ['required', 'min:6'],
        //     'avatar' => ['file'],
        // ]);

        $form = $request->all();
        $validator = Validator::make($form, [
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($user->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required','min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
            'avatar' => ['file'],
        ]);

        if($validator->fails()){
            return redirect()->route('user.profile.show', ['user'=>$user])
                    ->withErrors($validator)
                    ->withInput();
        }else{
            
            
            if($request->hasFile('avatar')){
                $image = base64_encode(file_get_contents($request->avatar->getRealPath()));
            }else{
                $image = NULL;
            }

            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->avatar = $image;
    
            // //hashing password
            $user->password = Hash::make($request->password);
    
            $user->save();
    
            return back();
        }

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
