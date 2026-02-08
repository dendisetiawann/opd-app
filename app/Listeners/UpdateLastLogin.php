<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class UpdateLastLogin
{
    protected $request;

    /**
     * Create the event listener.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        
        $user->update([
            'last_login_at' => now(),
            'last_login_ip' => $this->request->ip(),
            'last_login_device' => $this->parseUserAgent($this->request->userAgent()),
        ]);
    }

    /**
     * Parse user agent to get device info.
     */
    protected function parseUserAgent(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'Unknown';
        }

        $browser = 'Unknown Browser';
        $os = 'Unknown OS';

        // Detect browser
        if (str_contains($userAgent, 'Firefox')) {
            $browser = 'Firefox';
        } elseif (str_contains($userAgent, 'Edg')) {
            $browser = 'Edge';
        } elseif (str_contains($userAgent, 'Chrome')) {
            $browser = 'Chrome';
        } elseif (str_contains($userAgent, 'Safari')) {
            $browser = 'Safari';
        } elseif (str_contains($userAgent, 'Opera') || str_contains($userAgent, 'OPR')) {
            $browser = 'Opera';
        }

        // Detect OS
        if (str_contains($userAgent, 'Windows NT 10.0')) {
            $os = 'Windows 10/11';
        } elseif (str_contains($userAgent, 'Windows')) {
            $os = 'Windows';
        } elseif (str_contains($userAgent, 'Mac OS X')) {
            $os = 'macOS';
        } elseif (str_contains($userAgent, 'Linux')) {
            $os = 'Linux';
        } elseif (str_contains($userAgent, 'Android')) {
            $os = 'Android';
        } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
            $os = 'iOS';
        }

        return "$browser on $os";
    }
}
