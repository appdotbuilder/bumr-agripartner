import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
interface Partner {
    id: number;
    partner_code: string;
    organization_name: string;
    contact_person: string;
    status: string;
    total_investment: number;
    total_returns: number;
}

interface Stats {
    totalFields: number;
    activeFields: number;
    totalInvestment: number;
    totalReturns: number;
}

interface FieldUpdate {
    id: number;
    update_type: string;
    description: string;
    created_at: string;
    rice_field: {
        field_name: string;
    };
    user: {
        name: string;
    };
}

interface CommunityEvent {
    id: number;
    title: string;
    event_type: string;
    event_date: string;
    location?: string;
}

interface ForumDiscussion {
    id: number;
    title: string;
    category: string;
    replies_count: number;
    created_at: string;
    user: {
        name: string;
    };
}

interface Notification {
    id: number;
    title: string;
    message: string;
    type: string;
    created_at: string;
}

interface FinancialSummary {
    total_investment: number;
    total_revenue: number;
    total_profit: number;
    avg_price_per_kg: number;
}

interface Props {
    partner: Partner | null;
    stats: Stats;
    recentUpdates: FieldUpdate[];
    upcomingEvents: CommunityEvent[];
    recentDiscussions: ForumDiscussion[];
    unreadNotifications: Notification[];
    financialSummary: FinancialSummary | null;
    [key: string]: unknown;
}



export default function Dashboard({ 
    partner, 
    stats, 
    recentUpdates, 
    upcomingEvents, 
    recentDiscussions, 
    unreadNotifications,
    financialSummary 
}: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-PH', {
            style: 'currency',
            currency: 'PHP',
        }).format(amount);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-PH', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
        });
    };

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'active':
            case 'growing':
                return 'bg-green-100 text-green-800';
            case 'pending':
                return 'bg-yellow-100 text-yellow-800';
            case 'inactive':
                return 'bg-gray-100 text-gray-800';
            default:
                return 'bg-blue-100 text-blue-800';
        }
    };

    const getUpdateTypeIcon = (type: string) => {
        switch (type) {
            case 'photo': return '📸';
            case 'video': return '🎥';
            case 'inspection': return '🔍';
            case 'weather': return '🌤️';
            case 'pest_disease': return '🐛';
            case 'fertilizer': return '🌱';
            case 'irrigation': return '💧';
            default: return '📝';
        }
    };

    const getEventTypeIcon = (type: string) => {
        switch (type) {
            case 'workshop': return '🛠️';
            case 'training': return '📚';
            case 'meeting': return '🤝';
            case 'harvest_festival': return '🎉';
            case 'field_day': return '🌾';
            case 'webinar': return '💻';
            default: return '📅';
        }
    };

    return (
        <AppShell>
            <Head title="Partner Dashboard - BUMR AgriPartner" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">
                            Welcome back, {partner?.contact_person || 'Partner'}! 🌾
                        </h1>
                        <p className="text-gray-600 mt-1">
                            {partner ? `${partner.organization_name} - ${partner.partner_code}` : 'Complete your partner registration to get started'}
                        </p>
                    </div>
                    {partner && (
                        <div className={`px-3 py-1 rounded-full text-sm font-medium ${getStatusColor(partner.status)}`}>
                            {partner.status.charAt(0).toUpperCase() + partner.status.slice(1)}
                        </div>
                    )}
                </div>

                {/* Quick Stats */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Total Fields</p>
                                <p className="text-3xl font-bold text-gray-900">{stats.totalFields}</p>
                            </div>
                            <div className="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <span className="text-2xl">🌾</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Active Fields</p>
                                <p className="text-3xl font-bold text-gray-900">{stats.activeFields}</p>
                            </div>
                            <div className="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <span className="text-2xl">📊</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Total Investment</p>
                                <p className="text-2xl font-bold text-gray-900">{formatCurrency(stats.totalInvestment)}</p>
                            </div>
                            <div className="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <span className="text-2xl">💰</span>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div className="flex items-center justify-between">
                            <div>
                                <p className="text-sm font-medium text-gray-600">Total Returns</p>
                                <p className="text-2xl font-bold text-gray-900">{formatCurrency(stats.totalReturns)}</p>
                            </div>
                            <div className="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                <span className="text-2xl">📈</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Field Updates */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div className="p-6 border-b border-gray-100">
                            <h2 className="text-xl font-semibold text-gray-900">Recent Field Updates</h2>
                        </div>
                        <div className="p-6">
                            {recentUpdates.length > 0 ? (
                                <div className="space-y-4">
                                    {recentUpdates.map((update) => (
                                        <div key={update.id} className="flex items-start space-x-3">
                                            <div className="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span className="text-sm">{getUpdateTypeIcon(update.update_type)}</span>
                                            </div>
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900">
                                                    {update.rice_field.field_name}
                                                </p>
                                                <p className="text-sm text-gray-600 truncate">
                                                    {update.description}
                                                </p>
                                                <p className="text-xs text-gray-500 mt-1">
                                                    {formatDate(update.created_at)} by {update.user.name}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-8">No recent updates</p>
                            )}
                        </div>
                    </div>

                    {/* Upcoming Events */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div className="p-6 border-b border-gray-100">
                            <h2 className="text-xl font-semibold text-gray-900">Upcoming Events</h2>
                        </div>
                        <div className="p-6">
                            {upcomingEvents.length > 0 ? (
                                <div className="space-y-4">
                                    {upcomingEvents.map((event) => (
                                        <div key={event.id} className="flex items-start space-x-3">
                                            <div className="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span className="text-sm">{getEventTypeIcon(event.event_type)}</span>
                                            </div>
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900">{event.title}</p>
                                                <p className="text-sm text-gray-600">
                                                    {formatDate(event.event_date)}
                                                </p>
                                                {event.location && (
                                                    <p className="text-xs text-gray-500 mt-1">📍 {event.location}</p>
                                                )}
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-8">No upcoming events</p>
                            )}
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Forum Discussions */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div className="p-6 border-b border-gray-100">
                            <h2 className="text-xl font-semibold text-gray-900">Recent Discussions</h2>
                        </div>
                        <div className="p-6">
                            {recentDiscussions.length > 0 ? (
                                <div className="space-y-4">
                                    {recentDiscussions.map((discussion) => (
                                        <div key={discussion.id} className="flex items-start space-x-3">
                                            <div className="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <span className="text-sm">💬</span>
                                            </div>
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900 truncate">
                                                    {discussion.title}
                                                </p>
                                                <p className="text-sm text-gray-600">
                                                    {discussion.category.replace('_', ' ')} • {discussion.replies_count} replies
                                                </p>
                                                <p className="text-xs text-gray-500 mt-1">
                                                    by {discussion.user.name}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-8">No recent discussions</p>
                            )}
                        </div>
                    </div>

                    {/* Notifications */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div className="p-6 border-b border-gray-100">
                            <h2 className="text-xl font-semibold text-gray-900">Recent Notifications</h2>
                        </div>
                        <div className="p-6">
                            {unreadNotifications.length > 0 ? (
                                <div className="space-y-4">
                                    {unreadNotifications.slice(0, 5).map((notification) => (
                                        <div key={notification.id} className="flex items-start space-x-3">
                                            <div className="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900">
                                                    {notification.title}
                                                </p>
                                                <p className="text-sm text-gray-600 truncate">
                                                    {notification.message}
                                                </p>
                                                <p className="text-xs text-gray-500 mt-1">
                                                    {formatDate(notification.created_at)}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <p className="text-gray-500 text-center py-8">No new notifications</p>
                            )}
                        </div>
                    </div>
                </div>

                {/* Financial Summary */}
                {financialSummary && (
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div className="p-6 border-b border-gray-100">
                            <h2 className="text-xl font-semibold text-gray-900">Financial Summary</h2>
                        </div>
                        <div className="p-6">
                            <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div className="text-center">
                                    <p className="text-2xl font-bold text-gray-900">
                                        {formatCurrency(financialSummary.total_investment)}
                                    </p>
                                    <p className="text-sm text-gray-600">Total Investment</p>
                                </div>
                                <div className="text-center">
                                    <p className="text-2xl font-bold text-green-600">
                                        {formatCurrency(financialSummary.total_revenue)}
                                    </p>
                                    <p className="text-sm text-gray-600">Total Revenue</p>
                                </div>
                                <div className="text-center">
                                    <p className={`text-2xl font-bold ${financialSummary.total_profit >= 0 ? 'text-green-600' : 'text-red-600'}`}>
                                        {formatCurrency(financialSummary.total_profit)}
                                    </p>
                                    <p className="text-sm text-gray-600">Net Profit</p>
                                </div>
                                <div className="text-center">
                                    <p className="text-2xl font-bold text-gray-900">
                                        {formatCurrency(financialSummary.avg_price_per_kg)}
                                    </p>
                                    <p className="text-sm text-gray-600">Avg Price/kg</p>
                                </div>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AppShell>
    );
}