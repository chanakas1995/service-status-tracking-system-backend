<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Subject extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "subject";

    public $filters = ["name", "code"];

    protected $fillable = [
        'code',
        'name',
        'branch_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function employeeSubjects()
    {
        return $this->hasMany(EmployeeSubject::class);
    }
}
