<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $first_user = factory(App\User::class)->create([
            'name' => 'Alan Turing',
            'email' => 'alan.turing@gmail.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'facebook_id' => str_random(10),
            'avatar' => 'alan_turing.png',
        ]);

        $second_user = factory(App\User::class)->create([
            'name' => 'Ada Lovelace',
            'email' => 'ada.lovelace@gmail.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'facebook_id' => str_random(10),
            'avatar' => 'ada_lovelace.png',
        ]);

        self::createProjectPerUser($first_user);
        self::createProjectPerUser($second_user);

        self::createContributedProjects($first_user);
        self::createContributedProjects($second_user);

        factory(App\ProjectModel::class, 20)->create();
    }

    public function createContributedProjects($my_user) {
        // Create contribution for each created user and for first user
        $my_users = factory(App\User::class, 10)->create();
        $projects = factory(App\ProjectModel::class, 20)->create();
        $my_user->contributedProjects()->attach($projects);
        foreach ($my_users as $user) {
            $user->contributedProjects()->attach($projects);
        }

        // Confirm contribution
        foreach (App\ContributionModel::all() as $contr) {
            $contr->confirmation = 0;
            $contr->save();
        }
    }

    public function createProjectPerUser($user) {
        $user->each(function($u) {
            for ($index = 0; $index < 6; $index++) {
                $u->projects()->save(factory(App\ProjectModel::class)->make());
            }
        });
    }

}
