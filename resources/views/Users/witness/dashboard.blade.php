@extends('layouts.dashboard')
@section('title', 'My Reports')

@section('content')
  <div class="dash-title-row">
    <h1>My Reports</h1>
    <a href="{{ route('witness.reports.create') }}" class="btn btn-primary">+ Report a Crime</a>
  </div>

  <div class="card">
    <table class="dash-table">
      <thead>
        <tr><th>Reference</th><th>Incident Type</th><th>Location</th><th>Filed</th><th>Status</th><th></th></tr>
      </thead>
      <tbody>
        @forelse ($reports as $report)
          <tr>
            <td class="ref-code">{{ $report->reference() }}</td>
            <td>{{ $report->incident_type }}</td>
            <td>{{ $report->location }}</td>
            <!-- <td>{{ $report->date_reported->format('d M Y') }}</td> -->
            <td>
                {{ \Carbon\Carbon::parse($report->date_reported)->format('d M Y') }}
            </td>
            <td><span class="badge {{ $report->statusBadgeColor() }}">{{ $report->status }}</span></td>
            <td><a href="{{ route('witness.reports.show', $report) }}" style="color:var(--primary); font-weight:600;">View</a></td>
          </tr>
        @empty
          <tr><td colspan="6" class="empty-row">You haven't submitted any reports yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top:20px;">{{ $reports->links() }}</div>
@endsection
