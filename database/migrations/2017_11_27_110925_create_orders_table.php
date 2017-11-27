<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index(); // foreign key from users table
            $table->string('s3_id', 128);
            $table->integer('address_id');
            $table->integer('payment_id');
            $table->integer('delivery_id');
            $table->decimal('price_cart',10,2);
            $table->decimal('price_shipping',10,2);
            $table->decimal('price_discount',10,2);
            $table->string('price_discount_type',64)->default('');
            $table->string('price_discount_desc',255)->default('');
            $table->integer('status');
            $table->string('payment_session',255);
            $table->string('transaction_id',64);
            $table->string('order_hash',32);
            $table->string('order_pin',32);
            $table->string('order_currency',3);
            $table->tinyInteger('agreement_1')->default(0);
            $table->tinyInteger('agreement_2')->default(0);
            $table->text('comments');
            $table->tinyInteger('archived')->default(0);
            $table->tinyInteger('to_cron')->default(1);
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
        Schema::dropIfExists('orders');
    }
}
