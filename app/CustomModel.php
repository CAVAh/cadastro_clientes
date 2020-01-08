<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomModel
 * @package App
 * @package App\Http\Controllers
 * @property mixed id
 * @method static paginate()
 * @method static hydrate(array $items)
 * @method static Builder where(string $column, string $compars, string $string)
 */
class CustomModel extends Model
{
    /**
     * @return string
     */
    public function format() {
        return '';
    }
}
