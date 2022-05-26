<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users.index');
    }

    public function index(): View
    {
        $users = User::where('id', '!=', 1)->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user): view
    {
        $roles = Role::select('id', 'name')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(AdminUserUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $user->roles()->sync($validated['role']);
        return redirect()->route('admin.users.index')->with('information', 'Role assgined successfully!');
    }
}
