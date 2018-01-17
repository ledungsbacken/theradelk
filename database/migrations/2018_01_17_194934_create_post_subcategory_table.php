<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_subcategory', function (Blueprint $table) {
            $table->integer('post_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();

            $table->primary(['post_id', 'subcategory_id']);
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_subcategory');
    }
}
