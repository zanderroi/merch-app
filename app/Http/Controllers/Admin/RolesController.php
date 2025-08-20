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

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:roles,name',
            ]);
    
            Role::create(['name' => $request->name]);
    
            return redirect()->route('admin.roles.index')
                ->with('success', 'Role created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    }
}
