<?php

namespace App\Http\Controllers\Investigator;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\CaseStatusLog;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show(Request $request, Report $report)
    {
        abort_unless($report->assigned_investigator_id === $request->user()->id, 403);
        $report->load(['witness', 'evidence', 'messages.sender', 'statusLogs.updatedBy']);
        return view('Users.investigator.report-show', compact('report'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        abort_unless($report->assigned_investigator_id === $request->user()->id, 403);

        $validated = $request->validate(['status' => 'required|in:submitted,under review,resolved']);
        $oldStatus = $report->status;
        $report->update(['status' => $validated['status']]);

        CaseStatusLog::create([
            'report_id' => $report->id,
            'updated_by' => $request->user()->id,
            'old_status' => $oldStatus,
            'new_status' => $validated['status'],
            'updated_at' => now(),
        ]);

        ActivityLog::record('status_updated', "Report #{$report->id} moved from '{$oldStatus}' to '{$validated['status']}'");

        return back()->with('status', 'Case status updated.');
    }
}
