<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $gross_price
 * @property int $net_price
 * @property string $created_at
 * @property string $updated_at
 * @property BookingsServicesTire[] $bookingsServicesTires
 */
class ServicesTires extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'gross_price', 'net_price', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingsServicesTires()
    {
        return $this->hasMany('App\BookingsServicesTire', 'service_id');
    }
}
