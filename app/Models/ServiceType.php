<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class ServiceType extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "gsOffice";

    public $filters = ["service_type", "code"];

    protected $fillable = [
        'code',
        'service_type',
        'initial_subject_id',
    ];

    public function initialSubject()
    {
        return $this->belongsTo(Subject::class, 'initial_subject_id');
    }
}
