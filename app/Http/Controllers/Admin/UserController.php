<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users.index');
    }


    public function index(): View
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }


    public function edit(User $user): view
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    
    public function update(Request $request, User $user): RedirectResponse
    {

        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index', $user)->with('information', 'Role assgined successfully!');
    }

}
