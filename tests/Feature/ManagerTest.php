<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function only_manager_can_create_employee(): void
    {
        $manager = User::factory()->create();
        $manager->assignRole('manager');

        // 3. Login Sebagai manager
        $manager = $this->actingAs($manager, 'api');
        // dd($manager);
        $response = $manager->postJson('/api/employees/store', [
            "name" => "Agus Sanjaya",
            "email" => "diwier@mail.com",
            "password" => "employee12223",
            "fullname" => "Agus cbuswueb",
            "phone_number" => "085421351243",
            "address" => "Surabaya"
        ]);

        $response->assertStatus(201); // Created
    }
}