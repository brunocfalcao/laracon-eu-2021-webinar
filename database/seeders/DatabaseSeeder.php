<?php

namespace Database\Seeders;

use App\Models\ActionType;
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

        ActionType::create(['name' => 'new']);
        ActionType::create(['name' => 'update']);
        ActionType::create(['name' => 'assign']);
        ActionType::create(['name' => 'close']);
        ActionType::create(['name' => 'reopen']);

        User::factory(rand(10, 20))->create();

        // 1/3 are admins, 2/3 are non-admins.
        $admins = round(User::all()->count() / 3);

        $users = User::all()
                     ->shuffle()
                     ->take($admins)
                     ->each(function ($user) {
                        $user->profile()
                             ->associate(Profile::firstWhere('name', 'Admin'))
                             ->save();
                     });

        User::whereNull('profile_id')
            ->update(['profile_id' => Profile::firstWhere('name', 'Admin')->id]);
    }
}
