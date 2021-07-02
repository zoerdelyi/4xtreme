<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $machine_name
 * @property LevelsPermission[] $levelsPermissions
 */
class Permissions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'machine_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function levelsPermissions()
    {
        return $this->hasMany('App\LevelsPermission');
    }
}
