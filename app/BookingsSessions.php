<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $c_type
 * @property string $c_start_time
 * @property string $c_end_time
 * @property string $booking_started
 * @property string $created_at
 * @property string $updated_at
 */
class BookingsSessions extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['c_type', 'c_start_time', 'c_end_time', 'booking_started', 'created_at', 'updated_at'];

}
