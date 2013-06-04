<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBusinessesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function(Blueprint $table) {
            $table->increments('id');
			$table->string('slug')->unique();
			$table->string('name');
            $table->text('description');
            $table->string('location');
            $table->string('phone');
			$table->string('website');
            $table->timestamps();
        });

        Schema::create('business_user', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id')->index();
            $table->integer('user_id')->index();
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
        Schema::drop('businesses');
        # Schema::drop('business_contact');
        Schema::drop('business_user');
    }

}
