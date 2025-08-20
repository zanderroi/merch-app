<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //
    public function index(Request $request)
    {
        $roles = Role::all();

        return inertia('admin/Roles', [
            'roles' => $roles
        ]);
    }
}
