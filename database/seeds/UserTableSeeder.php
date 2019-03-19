<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = \App\Role::where('name', 'customer')->first();
        $role_manager  = \App\Role::where('name', 'dealer')->first();

        $employee = new \App\User();
        $employee->name = 'Customer Name';
        $employee->email = 'customer@example.com';
        $employee->password = bcrypt('secret');
        $employee->notification = 0;
        $employee->profile_image = '';
        $employee->save();

        $employee->roles()->attach($role_employee);

        $manager = new \App\User();
        $manager->name = 'Dealer Name';
        $manager->email = 'dealer@example.com';
        $manager->password = bcrypt('secret');
        $manager->notification = 0;
        $manager->profile_image = '';
        $manager->save();

        $manager->roles()->attach($role_manager);
  }
}
