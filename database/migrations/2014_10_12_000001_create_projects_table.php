<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            //Default
            $table->id();
            $table->rememberToken();
            $table->timestamps();

            //Fields
            $table->string('name');
            $table->boolean('external');
            $table->string('external_url')->nullable();
            $table->string('image');
            $table->text('description');
            $table->string('category');
            $table->integer('position')->nullable();
            $table->boolean('status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
