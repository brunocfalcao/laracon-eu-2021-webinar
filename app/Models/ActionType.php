<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    protected $guarded = [];

    public function incidentLogs()
    {
        return $this->hasMany(IncidentLog::class);
    }
}
