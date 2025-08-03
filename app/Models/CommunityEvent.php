<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommunityEvent
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $event_type
 * @property \Illuminate\Support\Carbon $event_date
 * @property \Illuminate\Support\Carbon|null $registration_deadline
 * @property string|null $location
 * @property string|null $virtual_link
 * @property int|null $max_participants
 * @property int $registered_count
 * @property array|null $agenda
 * @property array|null $speakers
 * @property string $status
 * @property string $organizer_name
 * @property string $organizer_contact
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|CommunityEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommunityEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommunityEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommunityEvent upcoming()
 * @method static \Database\Factories\CommunityEventFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class CommunityEvent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'event_type',
        'event_date',
        'registration_deadline',
        'location',
        'virtual_link',
        'max_participants',
        'registered_count',
        'agenda',
        'speakers',
        'status',
        'organizer_name',
        'organizer_contact',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'agenda' => 'array',
        'speakers' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope a query to only include upcoming events.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
                    ->where('event_date', '>=', now());
    }
}