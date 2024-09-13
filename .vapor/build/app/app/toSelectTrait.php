<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

trait toSelectTrait
{
    public function scopeToSelect(Builder $builder)
    {
        return $builder->get(['id', 'name'])->map(function ($platform) {
            return [
                'value' => $platform->id,
                'name'  => $platform->name,
            ];
        });
    }
}
