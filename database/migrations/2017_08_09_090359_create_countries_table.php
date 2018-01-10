<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uniqid');
            $table->char('iso',2);
            $table->string('nicename',80);
            $table->string('name',80);
            $table->char('iso3',3);
            $table->smallInteger('numcode');
            $table->integer('code');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
