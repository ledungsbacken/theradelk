<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('head_image_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('subtitle');
            $table->text('content');
            $table->string('slug');
            $table->float('opacity')->default(0.3);
            $table->boolean('is_fullscreen')->default(0);
            $table->boolean('hidden')->default(0);
            $table->timestamp('published')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('head_image_id')->references('id')->on('head_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}