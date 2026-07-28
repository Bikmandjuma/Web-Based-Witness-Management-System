@extends('layouts.dashboard')
@section('title', 'Admin Overview')

@section('content')
  <div class="dash-title-row"><h1>Overview</h1></div>

  <div class="stat-grid">
    <div class="stat-card"><b>{{ $stats['total_reports'] }}</b><span>Total reports</span></div>
    <div class="stat-card"><b>{{ $stats['unassigned_reports'] }}</b><span>Awaiting assignment</span></div>
    <div class="stat-card"><b>{{ $stats['active_investigators'] }}</b><span>Active investigators</span></div>
    <div class="stat-card"><b>{{ $stats['total_witnesses'] }}</b><span>Registered witnesses</span></div>
  </div>

  <div class="grid-2">
    <div class="card">
      <div class="card-head">
        <h2>Reports awaiting assignment</h2>
        <a href="{{ route('admin.reports.assign') }}" style="font-size:12.5px; font-weight:700; color:var(--primary);">Assign now &rarr;</a>
      </div>
      <div>
        @forelse ($unassignedReports as $report)
          <div style="padding:12px 20px; border-top:1px solid var(--border); font-size:13.5px;">
            <span class="ref-code">{{ $report->reference() }}</span>
            — {{ $report->incident_type }} ({{ $report->witness->full_name }})
          </div>
        @empty
          <p class="empty-row">All reports are currently assigned.</p>
        @endforelse
      </div>
    </div>

    <div class="card">
      <div class="card-head"><h2>Recent activity</h2></div>
      <div style="max-height:380px; overflow-y:auto;">
        @forelse ($recentActivity as $log)
          <div style="padding:12px 20px; border-top:1px solid var(--border); font-size:13.5px;">
            <p>{{ $log->description }}</p>
            <p style="font-size:11.5px; color:var(--ink-faint); margin-top:2px;">
                {{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}
            </p>
          </div>
        @empty
          <p class="empty-row">No activity recorded yet.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection
