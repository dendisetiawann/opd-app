<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opd extends Model
{
    protected $fillable = ['nama_opd'];

    /**
     * Get all users belonging to this OPD.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all web apps owned by this OPD.
     */
    public function webApps(): HasMany
    {
        return $this->hasMany(WebApp::class);
    }
}
