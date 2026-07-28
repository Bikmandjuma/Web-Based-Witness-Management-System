@extends('layouts.dashboard')
@section('title', 'Report a Crime')

@section('content')
  <div style="max-width:640px; margin:0 auto;">
    <h1 style="font-family:var(--font-display); font-size:24px; margin-bottom:6px;">Report a Crime</h1>
    <p style="color:var(--ink-soft); font-size:14px; margin-bottom:24px;">
      Your identity stays confidential — only the investigator assigned to this report will see your details.
    </p>

    <form method="POST" action="{{ route('witness.reports.store') }}" class="card" style="padding:24px;">
      @csrf

      <div class="field {{ $errors->has('incident_type') ? 'invalid' : '' }}" style="margin-bottom:18px;">
        <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Incident type</label>
        <select name="incident_type" required style="width:100%; padding:12px 14px; border:1.5px solid var(--border-strong); border-radius:var(--radius-sm); font-size:14.5px;">
          <option value="">Select a category…</option>
          <option value="Theft & burglary" {{ old('incident_type') === 'Theft & burglary' ? 'selected' : '' }}>Theft &amp; burglary</option>
          <option value="Fraud" {{ old('incident_type') === 'Fraud' ? 'selected' : '' }}>Fraud</option>
          <option value="Cybercrime" {{ old('incident_type') === 'Cybercrime' ? 'selected' : '' }}>Cybercrime</option>
          <option value="Corruption" {{ old('incident_type') === 'Corruption' ? 'selected' : '' }}>Corruption</option>
          <option value="Other" {{ old('incident_type') === 'Other' ? 'selected' : '' }}>Other</option>
        </select>
        <p class="error-text">{{ $errors->first('incident_type') }}</p>
      </div>

      <div class="field {{ $errors->has('location') ? 'invalid' : '' }}" style="margin-bottom:18px;">
        <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Location</label>
        <input type="text" name="location" value="{{ old('location') }}" required maxlength="150"
               placeholder="e.g. Kicukiro, Kigali"
               style="width:100%; padding:12px 14px; border:1.5px solid var(--border-strong); border-radius:var(--radius-sm); font-size:14.5px;">
        <p class="error-text">{{ $errors->first('location') }}</p>
      </div>

      <div class="field {{ $errors->has('description') ? 'invalid' : '' }}" style="margin-bottom:22px;">
        <label style="display:block; font-size:13.5px; font-weight:600; margin-bottom:7px;">Description</label>
        <textarea name="description" rows="6" required
                  placeholder="Describe what happened, when, and anything else that might help an investigator…"
                  style="width:100%; padding:12px 14px; border:1.5px solid var(--border-strong); border-radius:var(--radius-sm); font-size:14.5px;">{{ old('description') }}</textarea>
        <p class="error-text">{{ $errors->first('description') }}</p>
      </div>

      <button type="submit" class="btn btn-primary btn-block btn-lg">Submit Report</button>
      <p style="text-align:center; font-size:12.5px; color:var(--ink-faint); margin-top:12px;">
        You'll be able to attach photos, videos or documents right after submitting.
      </p>
    </form>
  </div>
@endsection
