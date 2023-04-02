<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTraits
{
    protected static function bootUuidTraits()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
