<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $booking_id
 * @property int $service_id
 * @property string $created_at
 * @property string $updated_at
 * @property BookingsCar $bookingsCar
 * @property ServicesCar $servicesCar
 */
class BookingsServicesCars extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['booking_id', 'service_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookingsCar()
    {
        return $this->belongsTo('App\BookingsCar', 'booking_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicesCar()
    {
        return $this->belongsTo('App\ServicesCar', 'service_id');
    }
}
