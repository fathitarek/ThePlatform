<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uniqid');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->integer('country_id')->unsigned();
            $table->enum('type',['company','personal']);
            $table->string('img_dir')->nullable();
            $table->string('img')->nullable();
            $table->integer('parent_id');
            $table->integer('active')->default(0);
            $table->integer('active_by')->default(0);
            $table->timestamp('active_date')->nullable();
            $table->integer('unactive_by')->default(0);
            $table->timestamp('unactive_date')->nullable();
            $table->integer('lastedit_by')->default(0);
            $table->timestamp('lastedit_date')->nullable();
            $table->integer('add_by')->default(0);
            $table->timestamp('add_date')->nullable();
            $table->integer('deleted_by')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_users');
    }
}
