<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('all', Role::class);

        $roles = Role::latest()->paginate(10);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('all', Role::class);

        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        Gate::authorize('all', Role::class);

        Role::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Role added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('all', Role::class);

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        Gate::authorize('all', Role::class);

        $role->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('all', Role::class);

        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully');
    }
}
