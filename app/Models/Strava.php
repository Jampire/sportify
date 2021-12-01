<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Strava
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class Strava extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'profile_id',
    ];

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get profile_url attribute
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return string
     */
    public function getProfileUrlAttribute(): string
    {
        return config('sportify.strava_profile_url') . $this->profile_id;
    }
}
