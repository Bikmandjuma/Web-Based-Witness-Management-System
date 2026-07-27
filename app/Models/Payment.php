<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'duration',
        'start_date',
        'end_date',
        'active_days',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
