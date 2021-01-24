<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Incident;
use App\Models\Priority;
use App\Models\Profile;
use App\Models\Requester;
use App\Models\Severity;
use App\Models\Status;
use App\Models\Tag;
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
        $faker = \Faker\Factory::create();

        Category::create(['name' => 'Emails']);
        Category::create(['name' => 'Registration']);
        Category::create(['name' => 'Sign In']);
        Category::create(['name' => 'Personal Data']);
        Category::create(['name' => 'Billing']);

        Priority::create(['name' => 'Non-urgent']);
        Priority::create(['name' => 'Urgent']);
        Priority::create(['name' => 'Critical']);

        Profile::create(['name' => 'Admin', 'is_admin' => true]);
        Profile::create(['name' => 'Operator', 'is_admin' => false]);

        Severity::create(['name' => 'Low']);
        Severity::create(['name' => 'Urgent']);
        Severity::create(['name' => 'Critical']);
        Severity::create(['name' => 'Disruptive']);

        Status::create(['name' => 'New']);
        Status::create(['name' => 'Assigned']);
        Status::create(['name' => 'Closed']);
        Status::create(['name' => 'Reopened']);

        Tag::create(['name' => 'Improvement needed']);
        Tag::create(['name' => 'Not case related']);
        Tag::create(['name' => 'Non-resolution possible']);

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
            ->update(['profile_id' => Profile::firstWhere('name', 'Operator')->id]);

        // Add a specific user - Admin.
        User::create([
            'name' => 'Bruno Falcao (Admin)',
            'password' => bcrypt('honda'),
            'email' => 'bruno@masteringnova.com',
            'profile_id' => Profile::firstWhere('name', 'Admin')->id,
        ]);

        // Add a specific user - Admin.
        User::create([
            'name' => 'Peter James (Operator)',
            'password' => bcrypt('honda'),
            'email' => 'peter@masteringnova.com',
            'profile_id' => Profile::firstWhere('name', 'Operator')->id,
        ]);

        // Create a random number of requesters.
        Requester::factory()->count(rand(10, 20))->create();

        /*
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

        //dd($this->newIncident());

        /**
         * Create Incidents from the past 180 days. Each day will have a
         * random number of incidents, and a random workflow state (1 to 7).
         **/
        $daysAgo = 90;

        for ($i = $daysAgo; $i >= 0; $i--) {
            $incident = $this->newIncident($i, true, rand(1, 10))
                             ->each(function ($incident) use ($faker) {
                                 $type = rand(1, 7);

                                 $totalTags = Tag::all()->count();
                                 // Also attach tags to the incident.
                                 $times = rand(1, $totalTags);

                                 for ($i = 0; $i < $times; $i++) {
                                     $randomTag = Tag::inRandomOrder()->first();
                                     $incident->tags()->attach($randomTag->id, ['comments' => $faker->sentence()]);
                                 }

                                 switch ($type) {
                                    case 1:
                                        // The non-assigned incident. Do nothing.
                                        break;

                                    case 2:
                                        // The assigned incident.
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();
                                        break;

                                    case 3:
                                        // The assigned and ressigned incident.
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();
                                        break;

                                    case 4:
                                        // The assigned and closed ticket.
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();
                                        break;

                                    case 5:
                                        // The assigned, ressigned and closed incident.
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();
                                        break;

                                    case 6:
                                        // The assigned, closed and reopened ticket.
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->status()->associate(Status::firstWhere('name', 'Reopened'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();
                                        break;

                                    case 7:
                                        // The assigned, reassigned, closed and reopened ticket.
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->user()->associate(User::inRandomOrder()->first());
                                        $incident->status()->associate(Status::firstWhere('name', 'Assigned'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->status()->associate(Status::firstWhere('name', 'Closed'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();

                                        $incident->fresh();
                                        $incident->status()->associate(Status::firstWhere('name', 'Reopened'));
                                        $incident->updated_at = $incident->updated_at->addSeconds(rand(3600, 24 * 3600));
                                        $incident->save();
                                        break;
                                }
                             });
        }

        // Create a random number of incidents created today.
        $this->newIncident(0, true, rand(1, 10));
    }

    protected function newIncident($daysAgo = 0, $save = true, $count = 1)
    {
        $incidents = Incident::factory()
            ->count($count)
            ->make()
            ->each(function ($incident) use ($daysAgo) {
                $incident->status()->associate(Status::find(1));

                $incident->requester()
                         ->associate(Requester::inRandomOrder()->first());

                $incident->severity()
                         ->associate(Severity::inRandomOrder()->first());

                $incident->priority()
                         ->associate(Priority::inRandomOrder()->first());

                $incident->category()
                         ->associate(Category::inRandomOrder()->first());

                $incident->updated_at = now()->subDays($daysAgo)->addSeconds(rand(1, 3600));
                $incident->created_at = $incident->updated_at;
                $incident->save();
            });

        return $count == 1 ? $incidents->first() : $incidents;
    }
}
