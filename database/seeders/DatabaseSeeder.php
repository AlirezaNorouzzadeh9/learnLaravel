<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\UserInfo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //  User::factory(10)
        //  ->has(UserInfo::factory(),'userInfo')
        //  ->create();
         User::factory(10)
         ->has(Role::factory(3),'roles')
         ->create();
    }
}
