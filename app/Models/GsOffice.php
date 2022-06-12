<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class GsOffice extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "gsOffice";

    protected $fillable = [
        'code',
        'name',
        'address',
        'phone',
        'gs_acting_id',
        'gs_permanent_id',
    ];

    public function gsActing()
    {
        return $this->belongsTo(Employee::class, 'gs_acting_id');
    }

    public function gsPermanent()
    {
        return $this->belongsTo(Employee::class, 'gs_permanent_id');
    }
}
