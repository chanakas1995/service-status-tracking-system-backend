<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class Bus extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "bus";

    public $filters = ["name", "reg_number"];

    protected $fillable = [
        'name',
        'reg_number',
        'chassis_no',
        'engine_no',
        'bus_model_id',
        'seat_count',
    ];


    public function busModel()
    {
        return $this->belongsTo(BusModel::class,'bus_model_id','id');
    }
}