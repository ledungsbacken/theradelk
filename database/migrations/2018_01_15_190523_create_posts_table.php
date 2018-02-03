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
            $table->integer('image_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('subtitle');
            $table->text('content');
            $table->string('slug');
            $table->string('updated_reason')->nullable();
            $table->boolean('hidden')->default(0);
            $table->boolean('published')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');
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
