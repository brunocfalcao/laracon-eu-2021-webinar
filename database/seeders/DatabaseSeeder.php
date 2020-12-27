<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Incident;
use App\Models\Priority;
use App\Models\Profile;
use App\Models\Requester;
use App\Models\Severity;
use App\Models\Status;
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

        Status::create(['name' => 'New']);
        Status::create(['name' => 'Assigned']);
        Status::create(['name' => 'Closed']);
        Status::create(['name' => 'Reopened']);

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
            ->update(['profile_id' => Profile::firstWhere('name', 'Non-Admin')->id]);

        Requester::factory()->count(50)->create();

        /**
         * Create incident workflows. Each incident can have different workflow types.
         *
         * 1. The non-assigned incident.
         * 2. The assigned incident.
         * 3. The assigned and reassigned incident.
         * 4. The assigned and closed incident.
         * 5. The assigned, reassigned, and closed incident.
         * 6. The assigned, closed and reopened incident.
         * 7. The assigned, reassigned, closed and reopened incident.
         *
         * Each incident workflow should have a natural timming order separated
         * by a randomly 120 hours period (0 hours to 5 days max).
         */
        Incident::factory()
                ->count(rand(200, 400))
                ->make()
                ->each(function ($incident) {
                    $incident->status()->associate(Status::find(1));
                    $incident->requester()->associate(Requester::inRandomOrder()->first());
                    $incident->severity()->associate(Severity::inRandomOrder()->first());
                    $incident->priority()->associate(Priority::inRandomOrder()->first());
                    $incident->category()->associate(Category::inRandomOrder()->first());
                    $incident->updated_at = now()->subHours(rand(120, 240));
                    $incident->created_at = $incident->updated_at;
                    $incident->save();
                });

        foreach (Incident::all() as $incident) {
            $type = rand(1, 7);

            switch ($type) {
                case 1:
                    // The non-assigned incident. Do nothing.
                    break;

                case 2:
                    // The assigned incident.
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();
                    break;

                case 3:
                    // The assigned and ressigned incident.
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();
                    break;

                case 4:
                    // The assigned and closed ticket.
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();
                    break;

                case 5:
                    // The assigned, ressigned and closed incident.
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();
                    break;

                case 6:
                    // The assigned, closed and reopened ticket.
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->status()->associate(Status::firstWhere('name', 'Reopened'));
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();
                    break;

                case 7:
                    // The assigned, reassigned, closed and reopened ticket.
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->user()->associate(User::inRandomOrder()->first());
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();

                    $incident->fresh();
                    $incident->status()->associate(Status::firstWhere('name', 'Reopened'));
                    $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
                    $incident->save();
                    break;
            }
        }

        return;

        $faker = \Faker\Factory::create();

        $incident = new Incident();
        $incident->requester()->associate(Requester::find(1));
        $incident->title = $faker->sentence();
        $incident->description = $faker->paragraph();
        $incident->updated_at = now()->subHours(rand(120, 240));
        $incident->created_at = $incident->updated_at;
        $incident->save();

        $incident->user_id = 2;
        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
        $incident->save();

        $incident->user_id = 4;
        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
        $incident->save();

        $incident->title = 'My title was changed';
        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24*3600));
        $incident->save();
    }

    private function assignIncident()
    {
    }

    private function reassignIncident()
    {
    }
}
