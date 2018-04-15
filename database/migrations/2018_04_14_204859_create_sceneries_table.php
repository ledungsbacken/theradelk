<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSceneriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sceneries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->unique()->nullable();
            $table->integer('first_post_id')->unsigned()->nullable();
            $table->integer('second_post_id')->unsigned()->nullable();
            $table->integer('third_post_id')->unsigned()->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('first_post_id')->references('id')->on('posts');
            $table->foreign('second_post_id')->references('id')->on('posts');
            $table->foreign('third_post_id')->references('id')->on('posts');
        });

        DB::table('sceneries')->insert([
            // Startpage
            [],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scenery');
    }
}
