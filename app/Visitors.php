<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property integer $phone
 * @property boolean $is_valid_data
 * @property string $created_at
 * @property string $updated_at
 * @property Booking[] $bookings
 */
class Visitors extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone', 'is_valid_data', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }
}
