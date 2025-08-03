<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\FinancialReport
 *
 * @property int $id
 * @property int $partner_id
 * @property int|null $rice_field_id
 * @property string $report_period
 * @property string $report_type
 * @property float $investment_amount
 * @property float $operational_costs
 * @property float $revenue
 * @property float $profit_loss
 * @property float $yield_kg
 * @property float $price_per_kg
 * @property array|null $cost_breakdown
 * @property array|null $revenue_breakdown
 * @property string|null $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Partner $partner
 * @property-read \App\Models\RiceField|null $riceField
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialReport query()
 * @method static \Database\Factories\FinancialReportFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class FinancialReport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'partner_id',
        'rice_field_id',
        'report_period',
        'report_type',
        'investment_amount',
        'operational_costs',
        'revenue',
        'profit_loss',
        'yield_kg',
        'price_per_kg',
        'cost_breakdown',
        'revenue_breakdown',
        'notes',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'investment_amount' => 'decimal:2',
        'operational_costs' => 'decimal:2',
        'revenue' => 'decimal:2',
        'profit_loss' => 'decimal:2',
        'yield_kg' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
        'cost_breakdown' => 'array',
        'revenue_breakdown' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the partner that owns the financial report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Get the rice field associated with the financial report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function riceField(): BelongsTo
    {
        return $this->belongsTo(RiceField::class);
    }
}