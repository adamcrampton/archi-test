<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'properties';
    protected $fillable = [
        'guid', 'suburb', 'state', 'country'
    ];

    public function analyticTypes()
    {
        return $this->belongsToMany(
            'App\Models\Analytics\AnalyticType',
            'property_analytics',
            'property_id',
            'analytic_type_id'
        )
        ->withPivot('value')
        ->withTimestamps();
    }
}
