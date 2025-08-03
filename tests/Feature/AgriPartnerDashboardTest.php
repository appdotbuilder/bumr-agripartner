<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Partner;
use App\Models\RiceField;
use App\Models\FieldUpdate;
use App\Models\FinancialReport;
use App\Models\CommunityEvent;
use App\Models\ForumDiscussion;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AgriPartnerDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_welcome_page_displays_correctly(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('welcome')
        );
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertInertia(fn ($assert) => $assert
            ->component('dashboard')
            ->has('partner')
            ->has('stats')
            ->has('recentUpdates')
            ->has('upcomingEvents')
            ->has('recentDiscussions')
            ->has('unreadNotifications')
            ->has('financialSummary')
        );
    }

    public function test_dashboard_displays_partner_information(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        $partner = Partner::where('user_id', $user->id)->first();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertInertia(fn ($assert) => $assert
            ->where('partner.id', $partner->id)
            ->where('partner.organization_name', $partner->organization_name)
            ->where('partner.partner_code', $partner->partner_code)
        );
    }

    public function test_dashboard_shows_correct_statistics(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        $partner = Partner::where('user_id', $user->id)->first();
        
        $totalFields = $partner->riceFields()->count();
        $activeFields = $partner->riceFields()->where('status', 'growing')->count();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertInertia(fn ($assert) => $assert
            ->where('stats.totalFields', $totalFields)
            ->where('stats.activeFields', $activeFields)
            ->where('stats.totalInvestment', $partner->total_investment)
            ->where('stats.totalReturns', $partner->total_returns)
        );
    }

    public function test_dashboard_includes_recent_field_updates(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertInertia(fn ($assert) => $assert
            ->has('recentUpdates')
        );
    }

    public function test_dashboard_shows_upcoming_events(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertInertia(fn ($assert) => $assert
            ->has('upcomingEvents')
        );
    }

    public function test_dashboard_displays_forum_discussions(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertInertia(fn ($assert) => $assert
            ->has('recentDiscussions')
        );
    }

    public function test_dashboard_shows_unread_notifications(): void
    {
        $user = User::where('email', 'demo@bumragripartner.com')->first();
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $response->assertInertia(fn ($assert) => $assert
            ->has('unreadNotifications')
        );
    }

    public function test_models_can_be_created(): void
    {
        $user = User::factory()->create();
        $partner = Partner::factory()->create(['user_id' => $user->id]);
        $riceField = RiceField::factory()->create(['partner_id' => $partner->id]);
        $fieldUpdate = FieldUpdate::factory()->create([
            'rice_field_id' => $riceField->id,
            'user_id' => $user->id,
        ]);
        $financialReport = FinancialReport::factory()->create(['partner_id' => $partner->id]);
        $event = CommunityEvent::factory()->create();
        $discussion = ForumDiscussion::factory()->create(['user_id' => $user->id]);
        $notification = Notification::factory()->create(['user_id' => $user->id]);

        $this->assertDatabaseHas('partners', ['id' => $partner->id]);
        $this->assertDatabaseHas('rice_fields', ['id' => $riceField->id]);
        $this->assertDatabaseHas('field_updates', ['id' => $fieldUpdate->id]);
        $this->assertDatabaseHas('financial_reports', ['id' => $financialReport->id]);
        $this->assertDatabaseHas('community_events', ['id' => $event->id]);
        $this->assertDatabaseHas('forum_discussions', ['id' => $discussion->id]);
        $this->assertDatabaseHas('notifications', ['id' => $notification->id]);
    }
}