<?php

use Illuminate\Database\Seeder;
use \App\Role;
use \App\User;
class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //Make role Admin
    $roleAdmin = Role::create([
      'name' => 'admin',
      'display_name' => 'Admin'
    ]);

    //make role member
    $roleMember = Role::create([
      'name' => 'member',
      'display_name' => 'Member'

    ]);

    //user example with role admin
    $adminUser = User::create([
      'name' => 'Admin Library',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('8slamp'),
      'is_verified' => 1
    ]);

    $adminUser->attachRole($roleAdmin);

    //user example with role member
    $memberUser = User::create([
      'name' => 'Member Library',
      'email' => 'member@gmail.com',
      'password' => bcrypt('8slamp'),
      'is_verified' => 1,
    ]);

    $memberUser->attachRole($roleMember);
  }
}
