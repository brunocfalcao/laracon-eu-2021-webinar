<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $guarded = [];

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }
}
