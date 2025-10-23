<?php

namespace App\Models;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends Model
{
    /** @use HasFactory<ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'address',
        'city',
        'zip',
        'email',
        'phone',
        'company',
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
     * @return BelongsToMany<BusinessEvent, $this>
     */
    public function businessEvents(): BelongsToMany
    {
        return $this->belongsToMany(BusinessEvent::class, 'business_event_contact', 'contact_id', 'business_event_id');
    }
}
