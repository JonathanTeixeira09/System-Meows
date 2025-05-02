<?php

namespace App\Traits;

use Hashids\Hashids;

trait HasHashid
{
    public function getHashidAttribute(): string
    {
        return $this->getHashidsInstance()->encode($this->id);
    }

    public static function findByHashid(string $hashid): ?self
    {
        $decoded = (new static)->getHashidsInstance()->decode($hashid);

        if (empty($decoded)) {
            return null;
        }

        return static::find($decoded[0]);
    }

    protected function getHashidsInstance(): Hashids
    {
        return new Hashids(config('app.name'), 12); // Salt = nome da app, mínimo de 10 caracteres
    }
}
