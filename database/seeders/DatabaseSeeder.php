<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'yusef',
            'last_name' => 'basiri',
            'national_code' => '1361361313',
            'phone_number' => '09149149191',
        ]);
    }
}
