<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $number_of_users = 50;
        $numbers_of_projects = 75;


        factory(App\User::class)->create([
            'name' => 'Alan Turing',
            'email' => 'alan.turing@gmail.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
            'facebook_id' => str_random(10),
        ])->each(function($u) {
            return $u->projects()->save(factory(App\ProjectModel::class)->create());
        });
        factory(App\User::class, $number_of_users)->create()->each(function($u) {
            return $u->projects()->save(factory(App\ProjectModel::class)->create());
        });


        factory(App\ProjectModel::class, $numbers_of_projects)->create();

        $user_id = 0;
        $project_id = 30;
        $number_of_contributed_projects = 30;
        $contributed_projects_per_user = 20;
        /* for ($i = 0; $i < $contributed_projects_per_user; $i++) {
          self::createContributedProjects($user_id, $project_id + $i,
          $number_of_contributed_projects);
          } */
    }

    public function createContributedProjects($user_id, $project_id,
            $number_of_contributed_projects) {
        while ($user_id < $number_of_contributed_projects) {
            $user_id++;
            $project_id--;
            factory(App\ContributionModel::class)->create([
                'id' => $user_id . '__' . $project_id,
                'id_user' => $user_id,
                'project_id' => $project_id,
            ]);
        }
    }

}
