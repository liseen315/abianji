<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialiteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->default('')->comment('名称');
            $table->string('nick_name')->default('')->comment('昵称');
            $table->string('avatar')->default('')->comment('头像');
            $table->string('email')->default('')->comment('第三方用户邮箱');
            $table->string('openid')->default('')->comment('第三方用户id');
            $table->string('access_token')->default('')->comment('access token');
            $table->string('login_ip')->default('')->comment('登录ip');
            $table->integer('login_times')->unsigned()->default(0)->comment('登录次数');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialite_users');
    }
}
