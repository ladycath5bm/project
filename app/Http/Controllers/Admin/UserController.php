<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\AdminUserUpdateRequest;

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

    public function update(AdminUserUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $user->roles()->sync($validated['role']);
        return redirect()->route('admin.users.index')->with('information', 'Role assgined successfully!');
    }
}
