<?php

namespace App\Models;

use App\Models\Profile;
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
}
