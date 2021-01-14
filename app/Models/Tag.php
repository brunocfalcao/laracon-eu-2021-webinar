<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function incidents()
    {
        return $this->belongsToMany(Incident::class)
                    ->withPivot('comments')
                    ->withTimestamps();
    }
}
