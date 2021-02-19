<?php

namespace App\Models\Properties;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAnalytic extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'property_analytics';
}
