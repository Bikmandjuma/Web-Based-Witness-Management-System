<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Report;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_reports'        => Report::count(),
            'unassigned_reports'   => Report::whereNull('assigned_investigator_id')->count(),
            'active_investigators' => User::where('role', 'investigator')->where('is_active', true)->count(),
            'total_witnesses'      => User::where('role', 'witness')->count(),
        ];

        $unassignedReports = Report::whereNull('assigned_investigator_id')
            ->with('witness')->latest('date_reported')->limit(10)->get();

        $recentActivity = ActivityLog::with('user')->latest('created_at')->limit(20)->get();

        return view('Users.admin.dashboard', compact('stats', 'unassignedReports', 'recentActivity'));
    }
}
