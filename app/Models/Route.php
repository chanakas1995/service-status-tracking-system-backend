<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class Route extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "bus";

    public $filters = ["name", "description"];

    protected $fillable = [
        'name',
        'description',
        'start_location_id',
        'end_location_id',
        'distance',
    ];

    public function startLocation()
    {
        return $this->hasOne(Location::class, 'id', 'start_location_id');
    }

    public function endLocation()
    {
        return $this->hasOne(Location::class, 'id', 'end_location_id');
    }


    
}