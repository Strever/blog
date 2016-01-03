<?php

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
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('sub_title');
            $table->tinyInteger('cate_id')->default(0);
            $table->text('content');
            $table->integer('comment_count')->default(1);
            $table->integer('visited_count')->default(1);
            $table->tinyInteger('comment_enabled')->default(1);
            $table->tinyInteger('is_show')->default(0);
            $table->string('tags');
            $table->timestamp('published_at');
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
        Schema::drop('articles');
    }
}
