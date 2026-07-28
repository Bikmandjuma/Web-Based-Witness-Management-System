<div class="card">
  <div class="card-head"><h2>Messages</h2></div>

  <div class="msg-thread">
    @forelse ($report->messages as $message)
      <div class="msg-bubble {{ $message->sender_id === auth()->id() ? 'msg-mine' : 'msg-theirs' }}">
        <p class="msg-meta">{{ $message->sender->full_name ?? $message->sender->name }}</p>
        <p>{{ $message->content }}</p>
        <!-- <p class="msg-meta" style="margin-top:4px; font-weight:400;">{{ $message->sent_at->format('d M, H:i') }}</p> -->
        <p class="msg-meta" style="margin-top:4px; font-weight:400;">
            {{ \Carbon\Carbon::parse($message->sent_at)->format('d M, H:i') }}
        </p>
      </div>
    @empty
      <p class="empty-row">No messages yet.</p>
    @endforelse
  </div>

  <form method="POST" action="{{ route('messages.store', $report) }}" class="msg-form">
    @csrf
    <input type="text" name="content" required maxlength="2000" placeholder="Write a message…">
    <button type="submit" class="btn btn-primary">Send</button>
  </form>
</div>
