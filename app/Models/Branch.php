<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Branch extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "branch";

    public $filters = ["name", "code"];

    protected $fillable = [
        'code',
        'name',
        'branch_head_id',
    ];

    public function branchHead()
    {
        return $this->belongsTo(Employee::class, 'branch_head_id');
    }
}
