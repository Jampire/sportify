<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class GoogleAuth
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class GoogleAuth extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'google_id',
        'nickname',
        'name',
        'email',
        'avatar',
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
}
