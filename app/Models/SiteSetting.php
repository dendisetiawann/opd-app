<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $table = 'pengaturan_situs';

    protected $fillable = ['key', 'value', 'type', 'group', 'label', 'order'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        $setting = Cache::remember("site_setting_{$key}", 3600, function () use ($key) {
            return static::where('key', $key)->first();
        });

        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value): void
    {
        static::where('key', $key)->update(['value' => $value]);
        Cache::forget("site_setting_{$key}");
        Cache::forget("site_settings_group_" . static::where('key', $key)->value('group'));
    }

    /**
     * Get all settings in a group, ordered.
     */
    public static function getGroup(string $group): \Illuminate\Database\Eloquent\Collection
    {
        return Cache::remember("site_settings_group_{$group}", 3600, function () use ($group) {
            return static::where('group', $group)->orderBy('order')->get();
        });
    }

    /**
     * Clear all site settings cache.
     */
    public static function clearCache(): void
    {
        $keys = static::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("site_setting_{$key}");
        }
        $groups = static::distinct()->pluck('group');
        foreach ($groups as $group) {
            Cache::forget("site_settings_group_{$group}");
        }
    }
}
