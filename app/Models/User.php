<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUlids, SoftDeletes, Billable;

    public const STRIPE_SUBSCRIPTION_NAME = 'default';

    protected $appends = [
        'is_premium',
        'is_subscribed',
        'is_trial',
        'is_on_grace_period',
        'can_create_campaign',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $withCount = [
        'campaigns',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function getIsTrialAttribute(): bool
    {
        return $this->onTrial(self::STRIPE_SUBSCRIPTION_NAME);
    }

    public function getIsPremiumAttribute(): bool
    {
        return $this->subscription(self::STRIPE_SUBSCRIPTION_NAME)?->active();
    }

    public function getIsSubscribedAttribute(): bool
    {
        return $this->subscribed(self::STRIPE_SUBSCRIPTION_NAME);
    }

    public function getIsOnGracePeriodAttribute(): bool
    {
        return $this->subscription(self::STRIPE_SUBSCRIPTION_NAME)?->onGracePeriod();
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class)->orderBy('created_at', 'desc');
    }

    public function getCanCreateCampaignAttribute(): bool
    {
        return $this->canCreateCampaign();
    }

    public function canCreateCampaign(): bool
    {
        return $this->subscribed(self::STRIPE_SUBSCRIPTION_NAME) &&
               $this->campaigns()->count() < $this->subscription(self::STRIPE_SUBSCRIPTION_NAME)->quantity;
    }
}
