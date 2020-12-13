<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentLog extends Model
{
    protected $guarded = [];

    protected $table = 'incident_logs';

    public function actionType()
    {
        return $this->belongsTo(ActionType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
