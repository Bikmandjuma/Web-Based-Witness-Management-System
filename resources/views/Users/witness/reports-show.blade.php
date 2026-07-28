@extends('layouts.dashboard')
@section('title', $report->reference())

@section('content')
  <a href="{{ route('witness.dashboard') }}" style="font-size:13.5px; color:var(--ink-faint);">&larr; Back to my reports</a>

  <div class="grid-2" style="margin-top:16px; align-items:start;">
    <div>
      <div class="detail-card">
        <div class="detail-head">
          <div>
            <p class="ref-code">{{ $report->reference() }}</p>
            <h1 style="font-family:var(--font-display); font-size:20px; margin-top:4px;">{{ $report->incident_type }}</h1>
            <p style="font-size:13px; color:var(--ink-faint);">{{ $report->location }} &middot; filed {{ $report->date_reported->format('d M Y, H:i') }}</p>
          </div>
          <span class="badge {{ $report->statusBadgeColor() }}">{{ $report->status }}</span>
        </div>
        <p class="detail-desc">{{ $report->description }}</p>

        @if ($report->investigator)
          <p style="margin-top:14px; font-size:12px; color:var(--ink-faint);">Assigned investigator: {{ $report->investigator->full_name }}</p>
        @else
          <p style="margin-top:14px; font-size:12px; color:var(--ink-faint);">Awaiting assignment to an investigator.</p>
        @endif
      </div>

      <div class="card" style="padding:20px;">
        <h2 style="font-size:15px; font-weight:700; margin-bottom:14px;">Evidence ({{ $report->evidence->count() }})</h2>

        <div class="evidence-grid">
          @foreach ($report->evidence as $file)
            <a href="{{ $file->url() }}" target="_blank" class="evidence-tile">
              <span class="icon">{{ $file->isImage() ? '🖼️' : '📄' }}</span>
              .{{ $file->file_type }}
            </a>
          @endforeach
        </div>

        <form method="POST" action="{{ route('witness.reports.evidence.store', $report) }}" enctype="multipart/form-data" class="form-inline">
          @csrf
          <input type="file" name="evidence[]" multiple accept=".jpg,.jpeg,.png,.mp4,.mov,.pdf" style="flex:1;">
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>
    </div>

    <div>
      @include('partials.messages-thread', ['report' => $report])
    </div>
  </div>
@endsection
