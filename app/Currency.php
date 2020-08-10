<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Currency
 *
 * @property int $id
 * @property string $code
 * @property float $usd_rate
 * @property Carbon|null $updated_at
 * @method static Builder|Currency newModelQuery()
 * @method static Builder|Currency newQuery()
 * @method static Builder|Currency query()
 * @method static Builder|Currency whereCode($value)
 * @method static Builder|Currency whereId($value)
 * @method static Builder|Currency whereUpdatedAt($value)
 * @method static Builder|Currency whereUsdRate($value)
 * @mixin Eloquent
 */
class Currency extends Model
{
    protected $fillable = [
        'usd_rate',
    ];
}
