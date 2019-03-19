<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new \App\Role();
        $role_employee->name = 'customer';
        $role_employee->description = 'A customer User';
        $role_employee->save();

        $role_manager = new \App\Role();
        $role_manager->name = 'dealer';
        $role_manager->description = 'A dealer User';
        $role_manager->save();
    }
}
