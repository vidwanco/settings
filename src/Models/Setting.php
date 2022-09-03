<?php

namespace Vidwan\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Vidwan\Settings\Traits\HasForm;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;
    use HasForm;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        $flush = fn ($model) => Cache::tags(["vidwanco-settings"])->flush();
        static::saved($flush);
        static::deleted($flush);
    }

    /**
     * Get the group setting belongs to
     *
     * @return mixed BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(SettingGroup::class);
    }

    /**
     * Get Default Attribute
     *
     * @return string $default
     */
    public function getDefaultAttribute(): string
    {
        $default = '';
        if ($this->data) {
            $default = $this->data['default'] ?? $default;
        }

        return $this->value ?
            (empty($this->value) ? $default : $this->value) :
            $default;
    }

    /**
     * Get Options for the field
     *
     * @return array $options
     */
    public function getOptionsAttribute(): array
    {
        $options = [];
        if ($this->data) {
            $options = $this->data['options'] ?? $options;
        }

        return $options;
    }

    /**
     * Get Option's Keys
     *
     * @return array Option $keys
     */
    public function optionKeys(): array
    {
        return array_keys($this->options);
    }

    /**
     * Get Form Name Attribute
     *
     * @return string Title Case
     */
    public function getLabelAttribute($value): string
    {
        return Str::title($value);
    }
}
