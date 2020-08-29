<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function show(User $user) {
        if (request()->is('admin/*')) {
            return view('admin.users.profile', ['user' => $user, 'roles' => Role::all()]);
        }
        return view('profile', ['user' => $user]);
    }

    public function update(User $user) {
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'.request('user_id'), 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['file'],
        ]);
        if (request('avatar')) {
            $response = cloudinary()
                ->upload(request()->file('avatar')->getRealPath())
                ->getSecurePath();
            $inputs['avatar'] = $response;
//            $inputs['avatar'] = 'storage/'.request('avatar')->store('images');
        }
        $user->update($inputs);
        return back();
    }

    public function attach(User $user) {
        $user->roles()->attach(request('role'));
        return back();
    }

    public function detach(User $user) {
        $user->roles()->detach(request('role'));
        return back();
    }

    public function destroy(User $user) {
        $user->delete();
        session()->flash('user-deleted', 'User account terminated!');
        return back();
    }
}
