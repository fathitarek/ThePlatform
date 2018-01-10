<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->integer('page_id');
            $table->text('message');
            $table->integer('lastedit_by');
            $table->timestamp('lastedit_date');
            $table->integer('add_by');
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
        Schema::dropIfExists('app_users_posts');
    }
}
