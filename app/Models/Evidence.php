<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    public $timestamps = false;
    protected $table = 'evidence';

    protected $fillable = ['report_id', 'file_path', 'file_type', 'uploaded_at'];

    protected function casts(): array
    {
        return ['uploaded_at' => 'datetime'];
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function url(): string
    {
        return route('evidence.download', $this->id);
    }

    public function isImage(): bool
    {
        return in_array(strtolower($this->file_type), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }
}
