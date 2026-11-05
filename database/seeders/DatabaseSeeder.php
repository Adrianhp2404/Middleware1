<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123');

        User::updateOrCreate(
            ['email' => 'admin@resort.com'],
            ['name' => 'Director General', 'password' => $password, 'is_admin' => true, 'age' => 40, 'balance' => 5000]
        );

        User::updateOrCreate(
            ['email' => 'adulto@resort.com'],
            ['name' => 'Huésped Adulto', 'password' => $password, 'is_admin' => false, 'age' => 28, 'balance' => 1000]
        );

        User::updateOrCreate(
            ['email' => 'menor@resort.com'],
            ['name' => 'Huésped Menor', 'password' => $password, 'is_admin' => false, 'age' => 16, 'balance' => 500]
        );
    }
}