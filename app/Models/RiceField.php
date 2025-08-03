<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\RiceField
 *
 * @property int $id
 * @property int $partner_id
 * @property string $field_name
 * @property string $location
 * @property float|null $latitude
 * @property float|null $longitude
 * @property float $area_hectares
 * @property string $rice_variety
 * @property \Illuminate\Support\Carbon $planting_date
 * @property \Illuminate\Support\Carbon $expected_harvest_date
 * @property string $status
 * @property float|null $expected_yield_tons
 * @property float|null $actual_yield_tons
 * @property array|null $weather_conditions
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Partner $partner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FieldUpdate> $fieldUpdates
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FinancialReport> $financialReports
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|RiceField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RiceField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RiceField query()
 * @method static \Database\Factories\RiceFieldFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class RiceField extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'partner_id',
        'field_name',
        'location',
        'latitude',
        'longitude',
        'area_hectares',
        'rice_variety',
        'planting_date',
        'expected_harvest_date',
        'status',
        'expected_yield_tons',
        'actual_yield_tons',
        'weather_conditions',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'area_hectares' => 'decimal:2',
        'expected_yield_tons' => 'decimal:2',
        'actual_yield_tons' => 'decimal:2',
        'weather_conditions' => 'array',
        'planting_date' => 'date',
        'expected_harvest_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the partner that owns the rice field.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Get the field updates for the rice field.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fieldUpdates(): HasMany
    {
        return $this->hasMany(FieldUpdate::class);
    }

    /**
     * Get the financial reports for the rice field.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financialReports(): HasMany
    {
        return $this->hasMany(FinancialReport::class);
    }
}