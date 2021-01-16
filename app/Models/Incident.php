<?php

namespace App\Models;

use App\Scopes\IncidentsScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Incident extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        //static::addGlobalScope(new IncidentsScope());
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)
            ->withPivot('comments')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requester()
    {
        return $this->belongsTo(Requester::class);
    }

    public function severity()
    {
        return $this->belongsTo(Severity::class);
    }

    public function logs()
    {
        return $this->hasMany(IncidentLog::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isFirstAssigned()
    {
        return $this->getOriginal('user_id') == null &&
               $this->wasChanged('user_id');
    }

    public function isReassigned()
    {
        return $this->getOriginal('user_id') != null &&
               $this->wasChanged('user_id');
    }

    public function isClosed()
    {
        return $this->status_id == Status::firstWhere('name', 'Closed')->id;
    }

    public function onlyContentUpdated()
    {
        return ! $this->isFirstAssigned() &&
               ! $this->isReassigned() &&
               ! $this->isClosed() &&
               $this->wasChanged();
    }

    public function scopeAssignedToMyself()
    {
        return $this->where('user_id', request()->user()->id);
    }
}
