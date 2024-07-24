<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\UserDetailsUpdated;
use App\Mail\WelcomeToDataManagementSystem;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        $users = User::has('role')
                    ->latest()
                    ->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', User::class);

        $roles = Role::exceptSecretRole()->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        Gate::authorize('create', User::class);

        $role = Role::findOrFail($request->role);
        
        $user = User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id
        ]);

        $user->load('role');

        Mail::to($user)->send(new WelcomeToDataManagementSystem($user, $request->password));

        return redirect()->back()->with('success', 'User added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::authorize('update', User::class);

        $user = User::has('role')->findOrFail($id);

        $roles = Role::exceptSecretRole()->get();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        Gate::authorize('update', User::class);

        $role = Role::findOrFail($request->role);

        $user->update([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'role_id' => $role->id
        ]);

        $user->load('role');

        Mail::to($user)->send(new UserDetailsUpdated($user));

        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', User::class);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    // export users in csv format
    public function export()
    {
        Gate::authorize('viewAny', User::class);

        $filename = 'users.csv';
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
    
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
    
            // CSV headers
            fputcsv($handle, [
                'First Name',
                'Last Name',
                'Email',
                'Role',
                'Created On'
            ]);
    
            User::has('role')
                ->with('role')
                ->latest()
                ->chunk(500, function ($users) use ($handle) {

                foreach ($users as $user) {

                    $data = [
                        $user->first_name ?? '',
                        $user->last_name ?? '',
                        $user->email ?? '',
                        $user->role?->name ?? '',
                        isset($user->created_at) ? Carbon::parse($user->created_at)->format('d M Y H:i:s') : ''
                    ];
    
                    // write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });
    
            // Close CSV file handle
            fclose($handle);

        }, 200, $headers);
    }
}
