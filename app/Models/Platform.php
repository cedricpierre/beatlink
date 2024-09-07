<?php

namespace App\Models;

use App\Casts\Service;
use App\toSelectTrait;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Platform extends Model
{
    use HasFactory, HasUlids, SoftDeletes, ToSelectTrait;

    protected $fillable = [
        'name',
    ];

    protected function casts(): array
    {
        return [
            'service' => Service::class,
        ];
    }
}
