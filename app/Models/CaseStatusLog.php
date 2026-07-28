<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStatusLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['report_id', 'updated_by', 'old_status', 'new_status', 'updated_at'];

    protected function casts(): array
    {
        return ['updated_at' => 'datetime'];
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
