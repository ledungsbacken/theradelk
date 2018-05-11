<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialLinkTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_link_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('description')->nullable();
        });

        DB::table('social_link_types')->insert([
            [
                'name' => 'linkedin',
                'label' => 'LinkedIn',
            ],
            [
                'name' => 'facebook',
                'label' => 'Facebook',
            ],
            [
                'name' => 'snapchat',
                'label' => 'Snapchat',
            ],
            [
                'name' => 'instagram',
                'label' => 'Instagram',
            ],
            [
                'name' => 'reddit',
                'label' => 'Reddit',
            ],
            [
                'name' => 'tumblr',
                'label' => 'Tumblr',
            ],
            [
                'name' => 'pinterest',
                'label' => 'Pinterest',
            ],
            [
                'name' => 'google',
                'label' => 'Google',
            ],
            [
                'name' => 'website',
                'label' => 'Website',
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
        Schema::dropIfExists('social_link_types');
    }
}