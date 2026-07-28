<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->filled('role'), fn ($q) => $q->where('role', $request->role))
            ->latest()->paginate(15)->withQueryString();

        return view('Users.admin.users-index', compact('users'));
    }

    public function toggleActive(User $user)
    {
        $user->update(['is_active' => ! $user->is_active]);

        ActivityLog::record(
            $user->is_active ? 'user_activated' : 'user_deactivated',
            "{$user->full_name} ({$user->role}) was " . ($user->is_active ? 'activated' : 'deactivated')
        );

        return back()->with('status', 'User account updated.');
    }

    public function updateRole(Request $request, User $user)
    {
        $validated = $request->validate(['role' => 'required|in:witness,investigator,admin']);
        $user->update(['role' => $validated['role']]);

        ActivityLog::record('role_changed', "{$user->full_name}'s role changed to {$validated['role']}");

        return back()->with('status', 'User role updated.');
    }
}
