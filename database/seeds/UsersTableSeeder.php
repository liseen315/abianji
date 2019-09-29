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
        //
        DB::table('users')->insert(
            [
                'name' => 'liseen',
                'email' => '5482611@qq.com',
                'password' => bcrypt('liseen'),
            ]
        );
    }
}
