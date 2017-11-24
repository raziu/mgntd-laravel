<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->integer('delivery_id')->unsigned();
            $table->timestamps();
        });

        //Schema::table('deliveries_countries', function(Blueprint $table) {
        //  $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        //  $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries_countries');
    }
}
