<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            # $table->string('email')->nullable()->index();
            $table->string('nin')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->default('unknown');
            $table->string('job')->nullable();
            $table->string('postal_address')->nullable();
            $table->enum('martial_status',array('single','married','divorced','widowed'))->nullable();
            $table->date('birthdate')->nullable();
            $table->string('notes')->nullable();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('business_id')->unsigned()->index()->nullable();
            $table->timestamps();

            $table->unique(['business_id','nin']);
            $table->unique(['business_id', 'user_id']);
            # $table->unique('email', 'business_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }

}
