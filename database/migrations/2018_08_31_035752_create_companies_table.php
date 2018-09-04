<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('image_id')->nullable();
            $table->unsignedInteger('company_progress_type_id')->nullable();
            $table->unsignedInteger('vertical_id')->nullable();
            $table->string('name');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('slug');
            $table->string('url')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->boolean('from_startup_school')->default(false);
            $table->timestamps();

            $table->foreign('image_id')
                ->references('id')
                ->on('images');

            $table->foreign('company_progress_type_id')
                ->references('id')
                ->on('company_progress_types');

            $table->foreign('vertical_id')
                ->references('id')
                ->on('verticals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
