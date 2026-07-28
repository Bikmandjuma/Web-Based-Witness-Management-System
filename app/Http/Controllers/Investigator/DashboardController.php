<?php

namespace App\Http\Controllers\Investigator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $reports = $request->user()->assignedReports()->with('witness')
            ->latest('date_reported')->paginate(10);

        $counts = [
            'submitted'    => (clone $request->user()->assignedReports())->where('status', 'submitted')->count(),
            'under review' => (clone $request->user()->assignedReports())->where('status', 'under review')->count(),
            'resolved'     => (clone $request->user()->assignedReports())->where('status', 'resolved')->count(),
        ];

        return view('Users.investigator.dashboard', compact('reports', 'counts'));
    }
}
