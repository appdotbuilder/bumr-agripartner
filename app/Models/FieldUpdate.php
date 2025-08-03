<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\FieldUpdate
 *
 * @property int $id
 * @property int $rice_field_id
 * @property int $user_id
 * @property string $update_type
 * @property string $description
 * @property array|null $media_urls
 * @property array|null $weather_data
 * @property array|null $growth_metrics
 * @property string|null $health_status
 * @property string|null $recommendations
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RiceField $riceField
 * @property-read \App\Models\User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|FieldUpdate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldUpdate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FieldUpdate query()
 * @method static \Database\Factories\FieldUpdateFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class FieldUpdate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'rice_field_id',
        'user_id',
        'update_type',
        'description',
        'media_urls',
        'weather_data',
        'growth_metrics',
        'health_status',
        'recommendations',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'media_urls' => 'array',
        'weather_data' => 'array',
        'growth_metrics' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the rice field that owns the field update.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function riceField(): BelongsTo
    {
        return $this->belongsTo(RiceField::class);
    }

    /**
     * Get the user that created the field update.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}