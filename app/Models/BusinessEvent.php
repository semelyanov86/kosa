<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Database\Factories\BusinessEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property CarbonImmutable $started_at
 * @property CarbonImmutable $ended_at
 */
class BusinessEvent extends Model
{
    /** @use HasFactory<BusinessEventFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'place',
        'started_at',
        'ended_at',
        'user_id',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany<Contact, $this>
     */
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'business_event_contact', 'business_event_id', 'contact_id');
    }

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }
}
