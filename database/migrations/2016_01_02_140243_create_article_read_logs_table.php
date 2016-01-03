<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleReadLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_read_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id');
            $table->unsignedBigInteger('ip');
            $table->unsignedInteger('visitor_id')->default(0);
            $table->unsignedInteger('client_type')->default(1);
            $table->timestamps();

            $table->index('article_id', 'idx_article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_read_logs');
    }
}
