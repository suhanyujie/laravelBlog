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
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id');
            $table->integer('subclass_id');
            $table->string('title');
            $table->integer('date');
            $table->integer('publish_date');
            $table->tinyInteger('publish_status');
            $table->text('content');
            $table->integer('user_id')->default(1);
            $table->tinyInteger('is_del');


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
