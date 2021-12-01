<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class EventLog
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class EventLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'track_url',
        'track_distance',
        'track_start_date',
        'track_duration',
    ];

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return BelongsTo
     */
    public function sportEvent(): BelongsTo
    {
        return $this->belongsTo(SportEvent::class);
    }
}
