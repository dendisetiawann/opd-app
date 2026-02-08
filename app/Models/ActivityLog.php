<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'action',
        'old_value',
        'new_value',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the user whose data was modified.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who performed the action.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Scope to filter by action type.
     */
    public function scopeOfAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Get human-readable action name.
     */
    public function getActionLabelAttribute(): string
    {
        return match($this->action) {
            'email_updated' => 'Email Diubah',
            'password_reset' => 'Password Direset',
            default => ucfirst(str_replace('_', ' ', $this->action)),
        };
    }
}
