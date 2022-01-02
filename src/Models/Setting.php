<?php

namespace Vidwanco\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'options' => 'array',
    ];

    /**
     * Get the group setting belongs to
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsTo
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
        if ($this->options) {
            foreach ($this->options as $key => $value) {
                $default = $key === 'default' ? $value : $default;
            }
        }

        return $this->value ?? $default;
    }

    /**
     * Get Options for the field
     *
     * @return array $options
     */
    public function options(): array
    {
        $options = [];
        if ($this->options) {
            foreach ($this->options as $key => $value) {
                $options = $key === 'options' ? $value : $options;
            }
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
        $options = $this->options();

        [$keys, $values] = Arr::divide($options);

        return $keys;
    }

    /**
     * Get Form Name Attribute
     *
     * @return string Title Case
     */
    public function getNameAttribute($value): string
    {
        return Str::title($value);
    }

    /**
     * Parse Form key Attribute
     *
     * @return string Title Case
     */
    public function formNameAttribute($value): string
    {
        return Str::title($value);
    }
}
