<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_published',
        'published_at',
        'acceptance_template_path',
        'template_filename',
        'announcement_notes',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get or create the singleton announcement setting.
     */
    public static function current(): self
    {
        return static::firstOrCreate([], [
            'is_published' => false,
            'published_at' => null,
            'acceptance_template_path' => null,
            'template_filename' => null,
            'announcement_notes' => null,
        ]);
    }
}
