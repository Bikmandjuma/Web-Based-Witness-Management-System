<?php

namespace App\Http\Controllers\Witness;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Evidence;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EvidenceController extends Controller
{
    public function store(Request $request, Report $report)
    {
        abort_unless($report->user_id === $request->user()->id, 403);

        $request->validate([
            'evidence.*' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,pdf|max:20480',
        ]);

        foreach ($request->file('evidence', []) as $file) {
            $path = $file->store('evidence/' . $report->id, 'private');

            $report->evidence()->create([
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'uploaded_at' => now(),
            ]);
        }

        ActivityLog::record('evidence_uploaded', "Evidence uploaded for report #{$report->id}");

        return back()->with('status', 'Evidence uploaded successfully.');
    }

    public function download(Request $request, Evidence $evidence)
    {
        $report = $evidence->report;
        $user = $request->user();

        $authorized = $user->id === $report->user_id
            || $user->id === $report->assigned_investigator_id
            || $user->isAdmin();

        abort_unless($authorized, 403);

        return Storage::disk('private')->response($evidence->file_path);
    }
}
