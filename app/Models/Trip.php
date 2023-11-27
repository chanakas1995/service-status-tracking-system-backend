<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class Trip extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "bus";

    public $filters = ["name","start_time","end_time","bus_id","route_id"];

    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'bus_id',
        'route_id',
    ];

    public function bus()
    {
         return $this->hasOne(Bus::class, 'id', 'bus_id');
    }

    public function route()
    {
         return $this->hasOne(Route::class, 'id', 'route_id');
    }

}