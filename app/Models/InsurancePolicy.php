<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\InsurancePolicy
 *
 * @property int $id
 * @property int $partner_id
 * @property string $policy_number
 * @property string $insurance_provider
 * @property string $policy_type
 * @property float $coverage_amount
 * @property float $premium_amount
 * @property \Illuminate\Support\Carbon $policy_start_date
 * @property \Illuminate\Support\Carbon $policy_end_date
 * @property string $status
 * @property array|null $coverage_details
 * @property array|null $risk_factors
 * @property string|null $terms_conditions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Partner $partner
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|InsurancePolicy active()
 * @method static \Database\Factories\InsurancePolicyFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class InsurancePolicy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'partner_id',
        'policy_number',
        'insurance_provider',
        'policy_type',
        'coverage_amount',
        'premium_amount',
        'policy_start_date',
        'policy_end_date',
        'status',
        'coverage_details',
        'risk_factors',
        'terms_conditions',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'coverage_amount' => 'decimal:2',
        'premium_amount' => 'decimal:2',
        'policy_start_date' => 'date',
        'policy_end_date' => 'date',
        'coverage_details' => 'array',
        'risk_factors' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the partner that owns the insurance policy.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Scope a query to only include active policies.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('policy_end_date', '>=', now());
    }
}