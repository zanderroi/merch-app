<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserManagementController extends Controller
{
    //
    public function index(Request $request)
    {
        return inertia('admin/UserManagement', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }
}
