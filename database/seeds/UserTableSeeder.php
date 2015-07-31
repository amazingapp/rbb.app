<?php

use Illuminate\Database\Seeder;
class UserTableSeeder extends Seeder {

    public function run()
    {
        factory('Banijya\User')->times(50)->create();
    }

}
