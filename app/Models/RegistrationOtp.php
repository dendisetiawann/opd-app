<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationOtp extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'name',
        'password',
        'opd_id',
        'expires_at',
        'last_sent_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'last_sent_at' => 'datetime',
    ];

    /**
     * Check if OTP has expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Check if can resend OTP (30 seconds cooldown)
     */
    public function canResend(): bool
    {
        if (!$this->last_sent_at) {
            return true;
        }
        return $this->last_sent_at->addSeconds(30)->isPast();
    }

    /**
     * Get seconds until can resend
     */
    public function secondsUntilResend(): int
    {
        if (!$this->last_sent_at) {
            return 0;
        }
        $nextResend = $this->last_sent_at->addSeconds(30);
        return max(0, now()->diffInSeconds($nextResend, false));
    }

    /**
     * Relationship to OPD
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
