<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $brand_id
 * @property string $created_at
 * @property string $updated_at
 * @property CarBrand[] $carBrands
 */
class CarTypes extends Model
{
    /**
     * @var array
     */
    protected $fillable = [ 'brand_id', 'name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carType()
    {
        return $this->belongsTo( 'App\CarBrands', 'brand_id');
    }
}
