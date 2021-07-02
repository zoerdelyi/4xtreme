<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $car_brand_id
 * @property int $visitor_id
 * @property string $licence_plate
 * @property string $comment
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 * @property string $updated_at
 * @property CarBrand $carBrand
 * @property Visitor $visitor
 * @property BookingsServicesCar[] $bookingsServicesCars
 */
class BookingsCars extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['car_brand_id', 'visitor_id', 'licence_plate', 'comment', 'start_time', 'end_time', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carBrand()
    {
        return $this->belongsTo('App\CarBrand');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingsServicesCars()
    {
        return $this->hasMany('App\BookingsServicesCar', 'booking_id');
    }
}
