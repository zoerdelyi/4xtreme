<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $date
 * @property boolean $is_work_day
 * @property string $created_at
 * @property string $updated_at
 */
class Workdays extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['date', 'is_work_day', 'created_at', 'updated_at'];

}
