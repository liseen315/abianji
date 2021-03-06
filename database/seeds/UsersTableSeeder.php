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
        var_dump(env('MAILGUN_DOMAIN'));
        // 清空
        DB::table('users')->truncate();

        DB::table('users')->insert(
            [
                'name' => 'liseen',
                'avatar' => 'https://res.cloudinary.com/dnakxpzhj/image/upload/v1572931080/blog/role.jpg',
                'email' => env('ADMIN_NAME'),
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]
        );
    }
}
