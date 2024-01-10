<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Notes;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*\App\Models\User::create([
            "name"=>"administrator",
            "email"=>"admin@admin.com",
            "password"=>Hash::make("password"),
        ]);*/
        User::factory()->count(25)->create();
        Notes::factory()->count(150)->create();
    }
}
