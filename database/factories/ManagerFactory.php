<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Manager::class;

    public function definition()
    {
        return [
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
