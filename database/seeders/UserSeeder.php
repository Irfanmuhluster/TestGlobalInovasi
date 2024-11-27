<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $superadmin = User::create([
            'name' => 'Dewangga',
            'email' => 'dewa23@mail.com',
            'password' => bcrypt('superadmin123'),
        ]);

        $superadmin->company()->create([
            'company_name' => 'CV. Dewangga Putra',
            'phone_number' => '08521651212',
            'address' => 'Yogya'
        ]);
        $superadmin->assignRole('superadmin');

        $manager = User::create([
            'name' => 'Irvan',
            'email' => 'manager1@mail.com',
            'password' => bcrypt('manager123'),
        ]);

        $manager->manager()->create([
            'fullname' => 'Irfan Harari',
            'address' => 'Klaten'
        ]);
        $manager->assignRole('manager');

        $employee = User::create([
            'name' => 'anton',
            'email' => 'anton@mail.com',
            'password' => bcrypt('employee123'),
        ]);

        $employee->employee()->create([
            'fullname' => 'Anton Subarjo',
            'phone_number' => '082671637124',
            'address' => 'Yogyakarta'
        ]);
        $manager->assignRole('employee');
    }
}
