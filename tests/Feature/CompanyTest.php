<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function only_superadmin_can_create_company(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        // 3. Login Sebagai SuperAdmin
        $this->actingAs($superadmin, 'api');

        $response = $this->postJson('/api/companies/store',[
            "company_name" => "Pt akjlkdsajdflidsjld",
            "phone_number" => "085323453233",
            "address"   => "Kulon Progo"
        ]);

        $response->assertStatus(201); // Created
    }
}
