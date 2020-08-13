<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Coordinates
 *
 * @property int $id
 * @property int $delivery_id
 * @property string $address
 * @property float $lat
 * @property float $lng
 * @method static Builder|Coordinates newModelQuery()
 * @method static Builder|Coordinates newQuery()
 * @method static Builder|Coordinates query()
 * @method static Builder|Coordinates whereAddress($value)
 * @method static Builder|Coordinates whereDeliveryId($value)
 * @method static Builder|Coordinates whereId($value)
 * @method static Builder|Coordinates whereLat($value)
 * @method static Builder|Coordinates whereLng($value)
 * @mixin Eloquent
 */
class Coordinates extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'delivery_id',
        'address',
        'lat',
        'lng',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
    ];
}
