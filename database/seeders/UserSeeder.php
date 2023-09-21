<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test1@test.test',
        'password' => Hash::make('test')
      ]);
      Log::info('created user from seeder', [$user]);
  
      $user = User::factory()->create([
        'name' => 'Test User 2',
        'email' => 'test2@test.test',
        'password' => Hash::make('test')
      ]);
      Log::info('created user from seeder', [$user]);

    }
}
