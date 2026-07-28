<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportAssignmentController extends Controller
{
    public function index()
    {
        $reports = Report::whereNull('assigned_investigator_id')
            ->with('witness')->latest('date_reported')->paginate(10);

        $investigators = User::where('role', 'investigator')->where('is_active', true)->get();

        return view('Users.admin.reports-assign', compact('reports', 'investigators'));
    }

    public function assign(Request $request, Report $report)
    {
        $validated = $request->validate(['investigator_id' => 'required|exists:users,id']);

        $investigator = User::where('id', $validated['investigator_id'])
            ->where('role', 'investigator')->firstOrFail();

        $report->update([
            'assigned_investigator_id' => $investigator->id,
            'status' => 'under review',
        ]);

        ActivityLog::record('report_assigned', "Report #{$report->id} assigned to {$investigator->full_name}");

        return back()->with('status', "Report #{$report->id} assigned to {$investigator->full_name}.");
    }
}
