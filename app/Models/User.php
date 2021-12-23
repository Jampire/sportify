<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

// TODO implement MustVerifyEmail

/**
 * Class User
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organization_id',
        'department_id',
        'socialite_id',
        'socialite_type',
        'socialite_token',
        'socialite_refresh_token',
        'socialite_expires_in',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'socialite_token',
        'socialite_refresh_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'socialite_expires_in' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     *
     * @return BelongsToMany
     */
    public function sportEvents(): BelongsToMany
    {
        return $this->belongsToMany(
            SportEvent::class,
            'user_event',
            'user_id',
            'event_id'
        )->as('participation');
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     *
     * @return HasMany
     */
    public function eventLogs(): HasMany
    {
        return $this->hasMany(EventLog::class);
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     *
     * @return HasOne
     */
    public function komoot(): HasOne
    {
        return $this->hasOne(Komoot::class);
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     *
     * @return HasOne
     */
    public function strava(): HasOne
    {
        return $this->hasOne(Strava::class);
    }
}
