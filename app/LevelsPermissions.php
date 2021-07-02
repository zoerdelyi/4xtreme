<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $level_id
 * @property int $permission_id
 * @property Level $level
 * @property Permission $permission
 */
class LevelsPermissions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['level_id', 'permission_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo('App\Permission');
    }
}
