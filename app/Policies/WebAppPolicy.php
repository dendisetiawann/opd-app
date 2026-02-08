<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WebApp;

class WebAppPolicy
{
    /**
     * Determine whether the user can view any web apps.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the web app.
     */
    public function view(User $user, WebApp $webApp): bool
    {
        // Admin can view all
        // Users can view their own apps
        // Users can view apps from the same OPD (read-only)
        return $user->isAdmin() || 
               $user->id === $webApp->user_id || 
               $user->opd_id === $webApp->opd_id;
    }

    /**
     * Determine whether the user can create web apps.
     */
    public function create(User $user): bool
    {
        return $user->isUser();
    }

    /**
     * Determine whether the user can update the web app.
     */
    public function update(User $user, WebApp $webApp): bool
    {
        // Only the owner can update
        return $user->id === $webApp->user_id;
    }

    /**
     * Determine whether the user can delete the web app.
     */
    public function delete(User $user, WebApp $webApp): bool
    {
        // Only the owner can delete
        return $user->id === $webApp->user_id;
    }
}
