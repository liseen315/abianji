<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'liseen',
                'email' => '5482611@qq.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('liu315song'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]
        );
    }
}
