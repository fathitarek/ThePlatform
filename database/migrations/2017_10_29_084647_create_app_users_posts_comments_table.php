<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersPostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users_posts_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_user_post_id');
            $table->integer('profile_id');
            $table->string('page_id');
            $table->string('post_id');
            $table->string('comment_id');
            $table->integer('like_count');
            $table->integer('comment_count');
            $table->text('message');
            $table->string('from_id');
            $table->string('from_name');
            $table->string('from_picture');
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
        Schema::dropIfExists('app_users_posts_comments');
    }
}
