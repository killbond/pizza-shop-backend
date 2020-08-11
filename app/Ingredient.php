<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Ingredient
 *
 * @method static Builder|Ingredient newModelQuery()
 * @method static Builder|Ingredient newQuery()
 * @method static Builder|Ingredient query()
 * @mixin Eloquent
 * @property int $id
 * @property string $name
 * @method static Builder|Ingredient whereId($value)
 * @method static Builder|Ingredient whereName($value)
 */
class Ingredient extends Model
{
    protected $fillable = [
        'name',
    ];
}
