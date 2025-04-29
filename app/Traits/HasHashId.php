<?php

namespace App\Traits;

use Hashids\Hashids;

trait HasHashId
{
    public function getHashIdAttribute()
    {
        return app(Hashids::class)->encode($this->id);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $id = app(Hashids::class)->decode($value)[0] ?? null;
        return parent::resolveRouteBinding($id, $field);
    }
}
