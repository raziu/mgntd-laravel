<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->unsigned()->index(); // foreign key from users table
          $table->string('fullname',70);
          $table->string('address',150);
          $table->string('city',30);
          $table->string('zip',15);
          $table->string('country',2);
          $table->string('email',128);
          $table->string('address_name',32);
          $table->string('s3_id', 64);
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
        Schema::dropIfExists('addresses');
    }
}
