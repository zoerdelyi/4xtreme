<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property boolean $week_day
 * @property string $start
 * @property string $end
 * @property string $created_at
 * @property string $updated_at
 */
class OpeningHours extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['week_day', 'start', 'end', 'created_at', 'updated_at'];

}
