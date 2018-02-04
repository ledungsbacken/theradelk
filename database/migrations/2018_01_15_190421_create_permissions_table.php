<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
        });

        DB::table('permissions')->insert([
            [
                'name' => 'access',
                'description' => 'Can login',
            ],
            [
                'name' => 'create_posts',
                'description' => 'Can create posts',
            ],
            [
                'name' => 'my_content',
                'description' => 'Can fully administer own posts',
            ],
            [
                'name' => 'admin_posts',
                'description' => 'Can admin all posts (publish, unpublish, set hidden, softdelete)',
            ],
            [
                'name' => 'admin_users',
                'description' => 'Can admin all users',
            ],
            [
                'name' => 'delete_posts',
                'description' => 'Can hard delete posts',
            ],
            [
                'name' => 'edit_posts',
                'description' => 'Can edit all posts',
            ],
            [
                'name' => 'full',
                'description' => 'Can do everything',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
