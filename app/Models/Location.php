<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Traits\HasUuid;

class Location extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "location";

    public $filters = ["name"];

    protected $fillable = [
        'name',
    ];

    public function route()
    {   
        return $this->hasMany(Route::class);
    }
}