<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        	\DB::table('users')->insert(array(
        		0 =>
        		array (
        			'id' => 1,
        			'name' => 'admin',
        			'email' => 'test@gmail.com',
        			'password' => bcrypt('123456'),
        			'remember_token' => NULL,
        			

        		),
        	));
    }
}
