import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface Props {
    auth?: {
        user?: {
            id: number;
            name: string;
            email: string;
        };
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    return (
        <>
            <Head title="BUMR AgriPartner - Rice Farming Partnership Platform" />
            <div className="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
                {/* Header */}
                <header className="relative bg-white shadow-sm border-b border-green-100">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-6">
                            <div className="flex items-center space-x-4">
                                <div className="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                                    <span className="text-white font-bold text-xl">🌾</span>
                                </div>
                                <div>
                                    <h1 className="text-2xl font-bold text-gray-900">BUMR AgriPartner</h1>
                                    <p className="text-sm text-gray-600">Rice Farming Partnership Platform</p>
                                </div>
                            </div>
                            <div className="flex items-center space-x-4">
                                {auth?.user ? (
                                    <Link href="/dashboard">
                                        <Button className="bg-green-600 hover:bg-green-700">
                                            Dashboard
                                        </Button>
                                    </Link>
                                ) : (
                                    <div className="flex space-x-3">
                                        <Link href="/login">
                                            <Button variant="outline" className="border-green-200 text-green-700 hover:bg-green-50">
                                                Login
                                            </Button>
                                        </Link>
                                        <Link href="/register">
                                            <Button className="bg-green-600 hover:bg-green-700">
                                                Join as Partner
                                            </Button>
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <main className="relative">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                        <div className="text-center mb-16">
                            <h2 className="text-5xl font-bold text-gray-900 mb-6">
                                🌾 Monitor Your Rice Farming
                                <span className="block text-green-600">Partnership Results</span>
                            </h2>
                            <p className="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                                Real-time insights, field monitoring, financial tracking, and community engagement 
                                for rice farming partners. Build sustainable agricultural partnerships with data-driven decisions.
                            </p>
                        </div>

                        {/* Features Grid */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                            {/* Partner Dashboard */}
                            <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 hover:shadow-xl transition-shadow">
                                <div className="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">📊</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 mb-4">Partner Dashboard</h3>
                                <ul className="text-gray-600 space-y-2">
                                    <li>• Real-time partnership metrics</li>
                                    <li>• Investment tracking & returns</li>
                                    <li>• Field performance overview</li>
                                    <li>• Yield predictions & analytics</li>
                                </ul>
                            </div>

                            {/* Field Monitoring */}
                            <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 hover:shadow-xl transition-shadow">
                                <div className="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">🗺️</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 mb-4">Field Monitoring</h3>
                                <ul className="text-gray-600 space-y-2">
                                    <li>• Interactive field maps</li>
                                    <li>• Photo & video updates</li>
                                    <li>• Growth stage tracking</li>
                                    <li>• Weather integration</li>
                                </ul>
                            </div>

                            {/* Financial Reports */}
                            <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 hover:shadow-xl transition-shadow">
                                <div className="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">💰</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 mb-4">Financial Reports</h3>
                                <ul className="text-gray-600 space-y-2">
                                    <li>• Detailed cost breakdowns</li>
                                    <li>• Revenue tracking</li>
                                    <li>• Profit/loss analysis</li>
                                    <li>• Market price insights</li>
                                </ul>
                            </div>

                            {/* Insurance & Risk */}
                            <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 hover:shadow-xl transition-shadow">
                                <div className="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">🛡️</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 mb-4">Insurance & Risk</h3>
                                <ul className="text-gray-600 space-y-2">
                                    <li>• Policy management</li>
                                    <li>• Risk assessment tools</li>
                                    <li>• Weather alerts</li>
                                    <li>• Claims tracking</li>
                                </ul>
                            </div>

                            {/* Community Events */}
                            <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 hover:shadow-xl transition-shadow">
                                <div className="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">🤝</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 mb-4">Community Events</h3>
                                <ul className="text-gray-600 space-y-2">
                                    <li>• Monthly workshops</li>
                                    <li>• Training sessions</li>
                                    <li>• Harvest festivals</li>
                                    <li>• Expert consultations</li>
                                </ul>
                            </div>

                            {/* Discussion Forum */}
                            <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 hover:shadow-xl transition-shadow">
                                <div className="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">💬</span>
                                </div>
                                <h3 className="text-xl font-semibold text-gray-900 mb-4">Discussion Forum</h3>
                                <ul className="text-gray-600 space-y-2">
                                    <li>• Technical discussions</li>
                                    <li>• Market price updates</li>
                                    <li>• Best practices sharing</li>
                                    <li>• Peer support network</li>
                                </ul>
                            </div>
                        </div>

                        {/* Stats Section */}
                        <div className="bg-white rounded-2xl p-8 shadow-lg border border-green-100 mb-16">
                            <h3 className="text-2xl font-bold text-center text-gray-900 mb-8">Platform Impact</h3>
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-green-600 mb-2">500+</div>
                                    <div className="text-gray-600">Active Partners</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-blue-600 mb-2">2,500</div>
                                    <div className="text-gray-600">Hectares Monitored</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-emerald-600 mb-2">₱50M</div>
                                    <div className="text-gray-600">Partnership Value</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-orange-600 mb-2">95%</div>
                                    <div className="text-gray-600">Success Rate</div>
                                </div>
                            </div>
                        </div>

                        {/* Call to Action */}
                        <div className="text-center bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl p-12 text-white">
                            <h3 className="text-3xl font-bold mb-4">Ready to Start Your Partnership?</h3>
                            <p className="text-xl mb-8 opacity-90">
                                Join hundreds of partners already benefiting from data-driven rice farming partnerships
                            </p>
                            {!auth?.user && (
                                <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                    <Link href="/register">
                                        <Button size="lg" className="bg-white text-green-600 hover:bg-gray-50 px-8 py-3 text-lg">
                                            🌾 Become a Partner
                                        </Button>
                                    </Link>
                                    <Link href="/login">
                                        <Button size="lg" variant="outline" className="border-white text-white hover:bg-white/10 px-8 py-3 text-lg">
                                            Sign In
                                        </Button>
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </main>

                {/* Footer */}
                <footer className="bg-white border-t border-green-100 py-12">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center">
                            <div className="flex items-center justify-center space-x-4 mb-4">
                                <div className="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold">🌾</span>
                                </div>
                                <span className="text-xl font-bold text-gray-900">BUMR AgriPartner</span>
                            </div>
                            <p className="text-gray-600">
                                Empowering sustainable rice farming partnerships through technology
                            </p>
                            <p className="text-sm text-gray-500 mt-4">
                                Built with Laravel & React • Responsive Design • Real-time Updates
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}