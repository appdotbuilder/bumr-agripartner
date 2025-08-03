<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Partner
 *
 * @property int $id
 * @property int $user_id
 * @property string $partner_code
 * @property string $organization_name
 * @property string $contact_person
 * @property string $phone
 * @property string $address
 * @property string $region
 * @property string $status
 * @property array|null $certification_documents
 * @property float $total_investment
 * @property float $total_returns
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RiceField> $riceFields
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FinancialReport> $financialReports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InsurancePolicy> $insurancePolicies
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner active()
 * @method static \Database\Factories\PartnerFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Partner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'partner_code',
        'organization_name',
        'contact_person',
        'phone',
        'address',
        'region',
        'status',
        'certification_documents',
        'total_investment',
        'total_returns',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'certification_documents' => 'array',
        'total_investment' => 'decimal:2',
        'total_returns' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rice fields for the partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function riceFields(): HasMany
    {
        return $this->hasMany(RiceField::class);
    }

    /**
     * Get the financial reports for the partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financialReports(): HasMany
    {
        return $this->hasMany(FinancialReport::class);
    }

    /**
     * Get the insurance policies for the partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insurancePolicies(): HasMany
    {
        return $this->hasMany(InsurancePolicy::class);
    }

    /**
     * Scope a query to only include active partners.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}