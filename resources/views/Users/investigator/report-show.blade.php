@extends('layouts.dashboard')
@section('title', $report->reference())

@section('content')
  <a href="{{ route('investigator.dashboard') }}" style="font-size:13.5px; color:var(--ink-faint);">&larr; Back to assigned cases</a>

  <div class="grid-2" style="margin-top:16px; align-items:start;">
    <div>
      <div class="detail-card">
        <div class="detail-head">
          <div>
            <p class="ref-code">{{ $report->reference() }}</p>
            <h1 style="font-family:var(--font-display); font-size:20px; margin-top:4px;">{{ $report->incident_type }}</h1>
            <p style="font-size:13px; color:var(--ink-faint);">
              Filed by {{ $report->witness->full_name }} &middot; {{ $report->location }} &middot;
              {{ $report->date_reported->format('d M Y, H:i') }}
            </p>
          </div>
          <span class="badge {{ $report->statusBadgeColor() }}">{{ $report->status }}</span>
        </div>
        <p class="detail-desc">{{ $report->description }}</p>
      </div>

      <div class="detail-card">
        <h2 style="font-size:15px; font-weight:700; margin-bottom:14px;">Update case status</h2>
        <form method="POST" action="{{ route('investigator.reports.status', $report) }}" class="form-inline">
          @csrf
          @method('PATCH')
          <select name="status" style="flex:1;">
            @foreach (['submitted', 'under review', 'resolved'] as $status)
              <option value="{{ $status }}" {{ $report->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>

        @if ($report->statusLogs->isNotEmpty())
          <div style="margin-top:18px; border-top:1px solid var(--border); padding-top:14px;">
            <p style="font-size:11.5px; font-weight:700; color:var(--ink-faint); text-transform:uppercase; letter-spacing:.05em; margin-bottom:8px;">History</p>
            <ul style="font-size:12.5px; color:var(--ink-soft); line-height:1.8; padding-left:0; list-style:none;">
              @foreach ($report->statusLogs as $log)
                <li>
                  {{ $log->updated_at->format('d M, H:i') }} —
                  {{ $log->updatedBy->full_name }} changed status
                  @if($log->old_status) from <strong>{{ $log->old_status }}</strong> @endif
                  to <strong>{{ $log->new_status }}</strong>
                </li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>

      <div class="card" style="padding:20px;">
        <h2 style="font-size:15px; font-weight:700; margin-bottom:14px;">Evidence ({{ $report->evidence->count() }})</h2>
        <div class="evidence-grid">
          @forelse ($report->evidence as $file)
            <a href="{{ $file->url() }}" target="_blank" class="evidence-tile">
              <span class="icon">{{ $file->isImage() ? '🖼️' : '📄' }}</span>
              .{{ $file->file_type }}
            </a>
          @empty
            <p class="empty-row" style="grid-column:1/-1;">No evidence has been uploaded for this report.</p>
          @endforelse
        </div>
      </div>
    </div>

    <div>
      @include('partials.messages-thread', ['report' => $report])
    </div>
  </div>
@endsection
