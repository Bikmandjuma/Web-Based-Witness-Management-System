<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Report $report)
    {
        $user = $request->user();

        $authorized = $user->id === $report->user_id
            || $user->id === $report->assigned_investigator_id
            || $user->isAdmin();

        abort_unless($authorized, 403);

        $validated = $request->validate(['content' => 'required|string|max:2000']);

        $report->messages()->create([
            'sender_id' => $user->id,
            'content' => $validated['content'],
            'sent_at' => now(),
        ]);

        return back()->with('status', 'Message sent.');
    }
}
