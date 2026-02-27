<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthCheckBatch extends Model
{
    protected $fillable = ['batch_id', 'total', 'completed', 'status', 'user_id', 'scope'];

    public function results()
    {
        return $this->hasMany(HealthCheckResult::class, 'batch_id', 'batch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getProgressPercentAttribute()
    {
        return $this->total > 0 ? round(($this->completed / $this->total) * 100) : 0;
    }
}
