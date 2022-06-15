<?php

namespace Vidwan\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingGroup extends Model
{
    use HasFactory;

    /**
     * Table to which the model belongs to
     *
     * @var string
     */
    protected $table = 'setting_groups';

    /**
     * Get Settings for the group
     *
     * @return
     */
    public function settings()
    {
        return $this->hasMany(Setting::class, 'setting_groups_id', 'id');
    }
}
