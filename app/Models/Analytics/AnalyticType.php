<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticType extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'analytic_types';
    protected $fillable = [
        'name', 'units', 'is_numeric', 'num_decimal_places'
    ];
}
