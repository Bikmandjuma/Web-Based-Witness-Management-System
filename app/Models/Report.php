<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'assigned_investigator_id', 'incident_type',
        'location', 'description', 'status', 'date_reported',
    ];

    protected function casts(): array
    {
        return ['date_reported' => 'datetime'];
    }

    public function witness()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function investigator()
    {
        return $this->belongsTo(User::class, 'assigned_investigator_id');
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('sent_at');
    }

    public function statusLogs()
    {
        return $this->hasMany(CaseStatusLog::class)->latest('updated_at');
    }

    public function statusBadgeColor(): string
    {
        return match ($this->status) {
            'submitted' => 'status-submitted',
            'under review' => 'status-review',
            'resolved' => 'status-resolved',
            default => 'status-submitted',
        };
    }

    public function reference(): string
    {
        return 'RPT-' . str_pad((string) $this->id, 5, '0', STR_PAD_LEFT);
    }
}
