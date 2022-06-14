<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Nonstandard\Uuid;
use Wildside\Userstamps\Userstamps;

class ServiceRequest extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "serviceRequest";

    public $filters = ["number"];

    protected $fillable = [
        'number',
        'description',
        'start_date',
        'end_date',
        'service_type_id',
        'customer_id',
        'duration',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function getCodeAttribute()
    {
        $serviceType = $this->serviceType;
        $initialSubject = $serviceType->initialSubject;
        $branch = $initialSubject->branch;
        return $branch->code . "-" . $initialSubject->code . "-" . $serviceType->code . "-" . str_pad($this->number, 5, "0", STR_PAD_LEFT);
    }

    // function getStatusAttribute()
    // {
    //     $lastEnrollment = $this->enrollments;
    // }
}
