<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Key/value store for system-wide settings (system name, support email, ...).
 */
class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    // IMPORTANT: the list of allowed settings and their default values.
    // The page works even before anything is saved, because missing rows
    // fall back to these defaults. To add a new setting, add it here, add a
    // validation rule in the controller, and add an input in the view.
    public const DEFAULTS = [
        'system_name'   => 'SmartHub Locker System',
        'support_email' => '',
        'support_phone' => '',
    ];

    /**
     * Get all settings as an array, with defaults filling any gaps.
     * Example: ['system_name' => 'SmartHub Locker System', ...]
     */
    public static function allWithDefaults(): array
    {
        // Only keep keys we know about, so old or unknown rows never leak into the page.
        $saved = array_intersect_key(
            static::pluck('value', 'key')->all(),
            self::DEFAULTS
        );

        // Saved values override the defaults.
        return array_merge(self::DEFAULTS, $saved);
    }

    /**
     * Get one setting, for example Setting::get('system_name').
     * Handy for using the system name in the navbar or page title.
     */
    public static function get(string $key, $default = null)
    {
        return static::allWithDefaults()[$key] ?? $default;
    }

    /**
     * Save one setting. Creates the row if it is missing, updates it if it exists.
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}