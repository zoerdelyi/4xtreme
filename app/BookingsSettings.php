<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $enabled
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 */
class BookingsSettings extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'enabled', 'content', 'created_at', 'updated_at'];

}
