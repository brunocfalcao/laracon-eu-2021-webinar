<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requester extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'requesters';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'extra_information' => 'array',
        'registration_date' => 'date'
    ];

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}
