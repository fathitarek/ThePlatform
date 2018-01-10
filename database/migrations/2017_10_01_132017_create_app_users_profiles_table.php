<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_user_id');
            $table->integer('page_id');
            $table->string('page_name');
            $table->string('page_image_url');
            $table->enum('type',['facebook','twitter','google','instagram','linkedin']);
            $table->timestamp('add_date');
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
        Schema::dropIfExists('app_users_profiles');
    }
}
