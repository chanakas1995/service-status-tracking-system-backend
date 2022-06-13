<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Customer extends Model
{
    use HasFactory,  HasUuid, SoftDeletes, Userstamps;

    public $entity = "employee";

    public $filters = ["first_name", "last_name", "email"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'address',
        'nic',
        'date_of_birth',
        'gender',
        'mobile',
        'home',
        'gs_office_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gsOffice()
    {
        return $this->belongsTo(GsOffice::class);
    }

    public function getNameAttribute()
    {
        return config('general.titles.' . $this->title) . ' ' . $this->first_name . ' ' . $this->last_name;
    }
}
