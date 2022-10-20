<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
  public function run()
  {
    $users = collect([[
      'name' => 'Prest Service',
      'email' => 'admin@prestservice.com',
      'password' => bcrypt('admin@1234'),
      'username' => User::generateUsername('Prest Service'),
    ]]);

    foreach($users as $user) User::updateOrCreate([
      'email' => $user['email']
    ],$user);
  }
}
