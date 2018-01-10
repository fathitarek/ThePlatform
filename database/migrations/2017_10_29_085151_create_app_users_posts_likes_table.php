<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersPostsLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users_posts_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_user_post_id');
            $table->integer('profile_id');
            $table->string('page_id');
            $table->string('post_id');
            $table->string('from_id');
            $table->string('from_name');
            $table->string('from_picture');
            $table->string('from_link');
            $table->string('from_pic_large');
            $table->string('from_pic_small');
            $table->timestamp('created_time');
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
        Schema::dropIfExists('app_users_posts_likes');
    }
}
