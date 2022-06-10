<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait HasUuid
{

    /**
     * Generate and insert uuid when creating a new resource 
     * @return void
     */
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = Uuid::uuid4()->toString();
            }
        });
    }

    /**
     * Bind id field to the route model binding
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function getKeyName()
    {
        return 'id';
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
