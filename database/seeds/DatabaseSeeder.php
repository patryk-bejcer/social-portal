<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('pl_PL');

        $numberOfUsers = 40;
        $password = 'pass';

        for ($i=1; $i <= $numberOfUsers; $i++){

            if ($i === 1){

                DB::table('users')->insert([
                    'name' => 'Patryk Bejcer',
                    'email' => 'patryk.bejcer@gmail.com',
                    'sex' => 'm',
                    'password' => bcrypt($password),
                ]);

            } else {

                $sex = $faker->randomElement(['m', 'f']);

                switch ($sex) {
                    case 'm':
                        $name = $faker->firstNameMale . ' ' . $faker->lastNameMale;
                        break;

                    case 'f':
                        $name = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
                        break;
                }

                DB::table('users')->insert([
                    'name' => $name,
                    'email' => str_replace('-', '', str_slug($name)) . '@' . $faker->safeEmailDomain,
                    'sex' => $sex,
                    'password' => bcrypt($password),
                ]);

            }

        }

    }
}
