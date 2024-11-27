<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $this->generateFor("company","api","superadmin");
        $this->generateFor("manager","api","manager");
        $this->generateFor("employee","api","employee");
    }

    public function generateFor($name, $guard, $menu_name){
        Permission::create(['name' => 'read_'.$name, 'guard_name'=>$guard, 'menu_name'=>$menu_name]);
        Permission::create(['name' => 'post_'.$name, 'guard_name'=>$guard, 'menu_name'=>$menu_name]);
        Permission::create(['name' => 'update_'.$name, 'guard_name'=>$guard, 'menu_name'=>$menu_name]);
        Permission::create(['name' => 'delete_'.$name, 'guard_name'=>$guard, 'menu_name'=>$menu_name]);
        Permission::create(['name' => 'show_'.$name, 'guard_name'=>$guard, 'menu_name'=>$menu_name]);
    }
}
