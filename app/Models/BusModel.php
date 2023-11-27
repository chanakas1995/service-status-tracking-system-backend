<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class BusModel extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "busModel";

    public $filters = ["name"];

    protected $fillable = [
        'name',
    ];

    public function bus()
    {   
        return $this->hasMany(Bus::class);
       
    }
}