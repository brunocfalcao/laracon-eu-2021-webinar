<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile_id' => 'integer',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function isAdmin()
    {
        return $this->profile->name == 'Admin';
    }

    public function isCoordinator()
    {
        return $this->profile->name == 'Coordinator';
    }

    public function scopeOperatorsOnly($query)
    {
        return $query->where('profile_id', Profile::firstWhere('name', 'Operator')->id);
    }
}
