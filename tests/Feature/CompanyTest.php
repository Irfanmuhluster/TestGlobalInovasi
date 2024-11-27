<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function only_superadmin_can_create_company(): void
    {
        $superadmin = User::factory()->create();
        $superadmin->assignRole('superadmin');

        // 3. Login Sebagai SuperAdmin
        $this->actingAs($superadmin, 'api');

        $response = $this->postJson('/api/employees/store', [
            "name" => "Agus Sanjaya",
            "email" => "agussujatmiko@mail.com",
            "password" => "employee123",
            "fullname" => "Agus Joyo HadikusuPermanamo",
            "phone_number" => "085421351243",
            "address" => "Surabaya"
        ]);

        $response->assertStatus(201); // Created
    }
}
