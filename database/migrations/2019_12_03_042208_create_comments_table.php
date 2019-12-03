<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->unsigned()->default(0)->comment('父级id');
            $table->integer('socialite_user_id')->unsigned()->default(0)->comment('关联socialite_user表的id');
            $table->integer('article_id')->unsigned()->comment('文章id');
            $table->text('markdown')->comment('markdown');
            $table->text('content')->comment('编码过的内容');
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
        Schema::dropIfExists('comments');
    }
}
