@extends('layouts.dashboard')
@section('title', 'Assigned Cases')

@section('content')
  <div class="dash-title-row"><h1>Assigned Cases</h1></div>

  <div class="stat-grid">
    <div class="stat-card"><b>{{ $counts['submitted'] }}</b><span>Newly submitted</span></div>
    <div class="stat-card"><b>{{ $counts['under review'] }}</b><span>Under review</span></div>
    <div class="stat-card"><b>{{ $counts['resolved'] }}</b><span>Resolved</span></div>
  </div>

  <div class="card">
    <table class="dash-table">
      <thead>
        <tr><th>Reference</th><th>Witness</th><th>Incident Type</th><th>Filed</th><th>Status</th><th></th></tr>
      </thead>
      <tbody>
        @forelse ($reports as $report)
          <tr>
            <td class="ref-code">{{ $report->reference() }}</td>
            <td>{{ $report->witness->full_name }}</td>
            <td>{{ $report->incident_type }}</td>
            <td>{{ $report->date_reported->format('d M Y') }}</td>
            <td><span class="badge {{ $report->statusBadgeColor() }}">{{ $report->status }}</span></td>
            <td><a href="{{ route('investigator.reports.show', $report) }}" style="color:var(--primary); font-weight:600;">Review</a></td>
          </tr>
        @empty
          <tr><td colspan="6" class="empty-row">No cases assigned to you yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top:20px;">{{ $reports->links() }}</div>
@endsection
