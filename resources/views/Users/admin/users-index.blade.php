@extends('layouts.dashboard')
@section('title', 'Manage Users')

@section('content')
  <div class="dash-title-row">
    <h1>Users</h1>
    <form method="GET">
      <select name="role" onchange="this.form.submit()" style="padding:8px 10px; border:1px solid var(--border-strong); border-radius:var(--radius-sm); font-size:13.5px;">
        <option value="">All roles</option>
        <option value="witness" {{ request('role') === 'witness' ? 'selected' : '' }}>Witnesses</option>
        <option value="investigator" {{ request('role') === 'investigator' ? 'selected' : '' }}>Investigators</option>
        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admins</option>
      </select>
    </form>
  </div>

  <div class="card">
    <table class="dash-table">
      <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td style="font-weight:600;">{{ $user->full_name ?? $user->name }}</td>
            <td style="color:var(--ink-faint);">{{ $user->email }}</td>
            <td>
              <form method="POST" action="{{ route('admin.users.update-role', $user) }}">
                @csrf @method('PATCH')
                <select name="role" onchange="this.form.submit()" style="padding:5px 8px; font-size:12px; border:1px solid var(--border-strong); border-radius:var(--radius-sm);">
                  @foreach (['witness', 'investigator', 'admin'] as $role)
                    <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                  @endforeach
                </select>
              </form>
            </td>
            <td>
              <span class="badge {{ $user->is_active ? 'status-resolved' : '' }}" style="{{ $user->is_active ? '' : 'background:var(--bg-tint); color:var(--ink-faint);' }}">
                {{ $user->is_active ? 'Active' : 'Deactivated' }}
              </span>
            </td>
            <td>
              <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}">
                @csrf @method('PATCH')
                <button type="submit" style="background:none; border:none; cursor:pointer; font-size:12px; font-weight:700; color:{{ $user->is_active ? 'var(--danger)' : 'var(--verified)' }};">
                  {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div style="margin-top:20px;">{{ $users->links() }}</div>
@endsection
