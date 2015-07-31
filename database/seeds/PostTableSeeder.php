<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        return factory('Banijya\Post')->times(100)->create();
    }
}
