<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use HasFactory, HasUuid;
}
