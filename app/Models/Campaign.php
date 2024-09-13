<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Nette\Utils\FileSystem;

class Campaign extends Model
{
    use HasFactory, HasUlids, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_dark',
        'background_url',
        'image_url',
    ];

    protected $appends = [
        'conversion_rate',
        'background_url',
        'image_url',
    ];

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'settings' => 'json',
            'is_dark'  => 'boolean',
            'leads_count' => 'integer',
            'views_count' => 'integer',
        ];
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class)->orderBy('id', 'asc');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class)->orderBy('id', 'desc');
    }

    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getConversionRateAttribute(): float|int
    {
        if ($this->views_count) {
            return round(100 / $this->views_count * $this->leads_count, 2);
        }
        return 0;
    }

    public function getBackgroundUrlAttribute(): string|null
    {
        if ($this->attributes['background_url']) {
            return Storage::disk('s3')->url($this->attributes['background_url']);
        }
        return null;
    }

    public function getImageUrlAttribute(): string|null
    {
        if ($this->attributes['image_url']) {
            return Storage::disk('s3')->url($this->attributes['image_url']);
        }
        return null;
    }
}
