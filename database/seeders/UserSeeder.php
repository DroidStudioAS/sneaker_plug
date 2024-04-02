<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numOfUsersToCreate = $this->command->getOutput()->ask("How Many Users Should The Seeder Create",10);
        $faker = Factory::create();
        $this->command->getOutput()->progressStart(500);
        for($i=1; $i<=$numOfUsersToCreate; $i++){
            User::create([
                "name"=>$faker->name,
                "email"=>$faker->email,
                "password"=>Hash::make("123456")
            ]);
            $this->command->getOutput()->progressAdvance(1);
        }
        $this->command->getOutput()->progressFinish();
    }
}
