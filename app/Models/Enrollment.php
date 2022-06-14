<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Enrollment extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "enrollment";

    public $filters = ["name", "code"];

    protected $fillable = [
        'service_request_id',
        'subject_id',
        'employee_id',
        'transferred_date',
        'start_date',
        'end_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }
}
