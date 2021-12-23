<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class Organization
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class Organization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'url',
    ];

    /**
     * Find Organization by user's email domain.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @param string $email
     * @return self
     */
    public static function findByEmail(string $email): self
    {
        return self::firstWhere('email_domain', Str::after($email, '@'));
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
