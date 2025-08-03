<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Partner;
use App\Models\RiceField;
use App\Models\FieldUpdate;
use App\Models\FinancialReport;
use App\Models\CommunityEvent;
use App\Models\ForumDiscussion;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgriPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a demo partner user
        $demoUser = User::create([
            'name' => 'Demo Partner',
            'email' => 'demo@bumragripartner.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Create the partner profile for demo user
        $demoPartner = Partner::create([
            'user_id' => $demoUser->id,
            'partner_code' => 'BUMR-DEMO',
            'organization_name' => 'Green Valley Rice Farm',
            'contact_person' => 'Demo Partner',
            'phone' => '+63 912 345 6789',
            'address' => '123 Rice Field Road, Nueva Ecija, Philippines',
            'region' => 'Region III',
            'status' => 'active',
            'certification_documents' => [
                'business_permit' => 'https://example.com/business-permit.pdf',
                'tax_clearance' => 'https://example.com/tax-clearance.pdf',
            ],
            'total_investment' => 250000.00,
            'total_returns' => 180000.00,
        ]);

        // Create rice fields for the demo partner
        $demoFields = RiceField::factory(3)->create([
            'partner_id' => $demoPartner->id,
        ]);

        // Create field updates for demo fields
        foreach ($demoFields as $field) {
            FieldUpdate::factory(random_int(2, 5))->create([
                'rice_field_id' => $field->id,
                'user_id' => $demoUser->id,
            ]);
        }

        // Create financial reports for demo partner
        FinancialReport::factory(6)->create([
            'partner_id' => $demoPartner->id,
            'rice_field_id' => $demoFields->random()->id,
        ]);

        // Create additional users and partners
        $users = User::factory(10)->create();
        
        foreach ($users as $user) {
            $partner = Partner::factory()->create([
                'user_id' => $user->id,
            ]);

            // Create rice fields for each partner
            $fields = RiceField::factory(random_int(1, 4))->create([
                'partner_id' => $partner->id,
            ]);

            // Create field updates
            foreach ($fields as $field) {
                FieldUpdate::factory(random_int(1, 3))->create([
                    'rice_field_id' => $field->id,
                    'user_id' => $user->id,
                ]);
            }

            // Create financial reports
            FinancialReport::factory(random_int(2, 5))->create([
                'partner_id' => $partner->id,
                'rice_field_id' => $fields->random()->id,
            ]);

            // Create notifications for the user
            Notification::factory(random_int(3, 8))->create([
                'user_id' => $user->id,
            ]);
        }

        // Create community events
        CommunityEvent::factory(10)->create();

        // Create forum discussions
        $allUsers = User::all();
        ForumDiscussion::factory(15)->create([
            'user_id' => $allUsers->random()->id,
        ]);

        // Create notifications for demo user
        Notification::factory(5)->create([
            'user_id' => $demoUser->id,
            'read_at' => null, // Unread notifications
        ]);

        $this->command->info('AgriPartner sample data created successfully!');
        $this->command->info('Demo login: demo@bumragripartner.com / password');
    }
}