<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class SportEvent
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class SportEvent extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'suspended',
    ];

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_event',
            'event_id',
            'user_id'
        );
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
}
