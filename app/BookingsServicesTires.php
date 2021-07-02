<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $booking_id
 * @property int $service_id
 * @property string $created_at
 * @property string $updated_at
 * @property BookingsTire $bookingsTire
 * @property ServicesTire $servicesTire
 */
class BookingsServicesTires extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['booking_id', 'service_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingsTire()
    {
        return $this->belongsTo('App\BookingsTire', 'booking_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicesTire()
    {
        return $this->belongsTo('App\ServicesTire', 'service_id');
    }
}
