<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends BaseSeeder
{
    protected $total = 50;


    public function getModel()
    {
       return new Post();
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'title' => $faker->sentence(),
            'user_id' => $this->getRandom('User')->id,
        ];
    }
}
