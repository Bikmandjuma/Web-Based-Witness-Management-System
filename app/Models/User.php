<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name',
        'name', // kept as an alias so any existing view using {{ $user->name }} still works
        'email',
        'phone',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ---------- role helpers ----------
    public function isWitness(): bool
    {
        return $this->role === 'witness';
    }

    public function isInvestigator(): bool
    {
        return $this->role === 'investigator';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // ---------- relationships ----------

    /** Reports filed by this user, when they are a witness. */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    /** Reports assigned to this user, when they are an investigator. */
    public function assignedReports()
    {
        return $this->hasMany(Report::class, 'assigned_investigator_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}
