<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Profile;
use App\Models\Severity;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Emails']);
        Category::create(['name' => 'Registration']);
        Category::create(['name' => 'Sign In']);
        Category::create(['name' => 'Personal Data']);
        Category::create(['name' => 'Billing']);

        Priority::create(['name' => 'Non-urgent']);
        Priority::create(['name' => 'Urgent']);
        Priority::create(['name' => 'Critical']);

        Profile::create(['name' => 'Admin']);
        Profile::create(['name' => 'Non-Admin']);

        Severity::create(['name' => 'Low']);
        Severity::create(['name' => 'Urgent']);
        Severity::create(['name' => 'Critical']);
        Severity::create(['name' => 'Disruptive']);

        User::factory(10)->create()->each(function ($user) {
        });
    }
}
