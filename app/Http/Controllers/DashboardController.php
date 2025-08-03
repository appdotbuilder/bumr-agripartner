<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\RiceField;
use App\Models\FinancialReport;
use App\Models\FieldUpdate;
use App\Models\CommunityEvent;
use App\Models\ForumDiscussion;
use App\Models\Notification;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the partner dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        
        // Basic stats
        $totalFields = $partner ? $partner->riceFields()->count() : 0;
        $activeFields = $partner ? $partner->riceFields()->where('status', 'growing')->count() : 0;
        $totalInvestment = $partner ? $partner->total_investment : 0;
        $totalReturns = $partner ? $partner->total_returns : 0;
        
        // Recent field updates
        $recentUpdates = $partner ? 
            FieldUpdate::whereHas('riceField', function ($query) use ($partner) {
                $query->where('partner_id', $partner->id);
            })->with(['riceField', 'user'])->latest()->take(5)->get() : collect();
        
        // Upcoming events
        $upcomingEvents = CommunityEvent::upcoming()->take(3)->get();
        
        // Recent forum discussions
        $recentDiscussions = ForumDiscussion::active()
            ->with('user')
            ->latest('last_activity')
            ->take(5)
            ->get();
        
        // Unread notifications
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->unread()
            ->latest()
            ->take(10)
            ->get();
        
        // Financial summary
        $financialSummary = $partner ?
            FinancialReport::where('partner_id', $partner->id)
                ->selectRaw('
                    SUM(investment_amount) as total_investment,
                    SUM(revenue) as total_revenue,
                    SUM(profit_loss) as total_profit,
                    AVG(price_per_kg) as avg_price_per_kg
                ')
                ->first() : null;
        
        return Inertia::render('dashboard', [
            'partner' => $partner,
            'stats' => [
                'totalFields' => $totalFields,
                'activeFields' => $activeFields,
                'totalInvestment' => $totalInvestment,
                'totalReturns' => $totalReturns,
            ],
            'recentUpdates' => $recentUpdates,
            'upcomingEvents' => $upcomingEvents,
            'recentDiscussions' => $recentDiscussions,
            'unreadNotifications' => $unreadNotifications,
            'financialSummary' => $financialSummary,
        ]);
    }
}