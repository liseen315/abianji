<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->default(0)->comment('分类id');
            $table->string('title')->default('')->comment('文章标题');
            $table->string('description')->nullable()->comment('用与在首页显示的文章描述');
            $table->string('slug')->default('')->comment('slug');
            $table->bigInteger('author_id')->default('1')->comment('作者id默认就是Liseen了');
            $table->text('markdown')->comment('markdown');
            $table->text('content')->comment('编码过的内容');
            $table->integer('views')->default(0)->comment('浏览数');
            $table->string('cover')->nullable()->comment('封面图');
            $table->boolean('is_top')->default(0)->comment('是否置顶 0 不置顶 1置顶');
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
        Schema::dropIfExists('articles');
    }
}
