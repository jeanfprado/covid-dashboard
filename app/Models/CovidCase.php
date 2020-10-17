<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidCase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'state', 'city', 'place_type', 'confirmed', 'death_rate',
        'deaths', 'order_for_place','is_last', 'estimated_population_2019', 
        'estimated_population','city_ibge_code', 'confirmed_per_100k_inhabitants',
    ];
}
