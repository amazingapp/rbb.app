<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    protected $tables = [
        'users',
        'posts'
    ];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        $this->truncate();

		 $this->call('UserTableSeeder');
         $this->call('PostTableSeeder');
	}

    private function truncate()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach($this->tables as $table)
        {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
