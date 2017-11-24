<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index(); // foreign key from users table
            $table->text('pictures');
            $table->string('status', 20)->default('saved');
            $table->integer('quantity');
            $table->bigInteger('order_id'); // foreign key from orders table
            $table->string('type', 20)->default('3x3');
            $table->string('s3_id', 128);
            $table->string('product_type', 20)->default('magnets');
            $table->decimal('price', 10, 2);
            $table->string('border_color', 7)->default('#FFFFFF');
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
        Schema::dropIfExists('baskets');
    }
}
