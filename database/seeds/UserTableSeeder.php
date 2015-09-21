<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdmin();
        $this->createMultiple(9);
    }

    public function getModel()
    {
        return new User();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('admin'),
            ];
    }

    private function createAdmin()
    {
        $this->create([

            'name' => 'Denny Lopez',
            'email' => 'dennyrock18@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
