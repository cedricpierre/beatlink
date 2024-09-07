<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ip',
        'user_agent',
        'country',
        'country_code',
        'referrer',
        'email',
        'name',
        'phone',
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
