<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('image_id')->nullable();
            $table->unsignedInteger('subdivision_id')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('email_token');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('image_id')
                ->references('id')
                ->on('images');

            $table->foreign('subdivision_id')
                ->references('id')
                ->on('subdivisions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
