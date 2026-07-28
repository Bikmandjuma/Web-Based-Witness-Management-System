<?php

namespace App\Http\Controllers\Witness;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = $request->user()->reports()->latest('date_reported')->paginate(10);
        return view('Users.witness.dashboard', compact('reports'));
    }

    public function create()
    {
        return view('Users.witness.reports-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'incident_type' => 'required|string|max:50',
            'location'      => 'required|string|max:150',
            'description'   => 'required|string|max:5000',
        ]);

        $report = $request->user()->reports()->create([
            ...$validated,
            'status' => 'submitted',
            'date_reported' => now(),
        ]);

        ActivityLog::record('report_submitted', "Report #{$report->id} submitted by {$request->user()->full_name}");

        return redirect()->route('witness.reports.show', $report)
            ->with('status', 'Your report has been submitted. You can track its status here, and attach evidence below.');
    }

    public function show(Request $request, Report $report)
    {
        abort_unless($report->user_id === $request->user()->id, 403);
        $report->load(['evidence', 'messages.sender', 'investigator']);
        return view('Users.witness.reports-show', compact('report'));
    }
}
