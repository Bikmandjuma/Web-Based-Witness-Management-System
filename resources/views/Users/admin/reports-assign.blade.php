@extends('layouts.dashboard')
@section('title', 'Assign Reports')

@section('content')
  <div class="dash-title-row"><h1>Assign Reports to Investigators</h1></div>

  <div class="card">
    <table class="dash-table">
      <thead><tr><th>Reference</th><th>Witness</th><th>Incident Type</th><th>Filed</th><th>Assign to</th></tr></thead>
      <tbody>
        @forelse ($reports as $report)
          <tr>
            <td class="ref-code">{{ $report->reference() }}</td>
            <td>{{ $report->witness->full_name }}</td>
            <td>{{ $report->incident_type }}</td>
            <tr>
                <td>{{ \Carbon\Carbon::parse($report->date_reported)->format('d M Y') }}</td>
            </tr>
            <td>
              <form method="POST" action="{{ route('admin.reports.assign.store', $report) }}" class="form-inline">
                @csrf @method('PATCH')
                <select name="investigator_id" required>
                  <option value="">Select investigator…</option>
                  @foreach ($investigators as $investigator)
                    <option value="{{ $investigator->id }}">{{ $investigator->full_name }}</option>
                  @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Assign</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="empty-row">No unassigned reports right now.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div style="margin-top:20px;">{{ $reports->links() }}</div>
@endsection
