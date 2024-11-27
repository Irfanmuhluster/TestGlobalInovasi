<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name' => 'superadmin','guard_name'=>'api'])->givePermissionTo(['read_company','post_company','show_company','update_company','delete_company']);
        Role::create(['name' => 'manager','guard_name'=>'api'])->givePermissionTo(['read_employee','read_manager','show_manager','show_employee','update_manager','post_employee','update_employee','delete_employee','show_employee']);
        Role::create(['name' => 'employee','guard_name'=>'api'])->givePermissionTo(['read_employee','show_employee']);
    }
}
