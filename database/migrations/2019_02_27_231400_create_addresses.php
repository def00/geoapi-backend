<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('ip', 128);
            $table->unsignedInteger('user_id');
            $table->string('type', 10);
            $table->string('continent_code', 50)->nullable();
            $table->string('continent_name', 100)->nullable();
            $table->string('country_code', 50)->nullable();
            $table->string('country_name', 255)->nullable();
            $table->string('region_code', 50)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('zip', 128)->nullable();
            $table->decimal('latitude', 15, 10)->nullable();
            $table->decimal('longitude', 15, 10)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
