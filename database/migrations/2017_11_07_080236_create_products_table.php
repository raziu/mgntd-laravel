<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('active')->default(0);
            $table->enum('group', array('magnets', 'prints', 'posters'))->default('magnets');
            $table->string('type_pre', 32);
            $table->string('type', 64)->default('3x3|2x2|1x9');
            $table->string('image', 128);
            $table->text('intro');
            $table->string('item_size', 64);
            $table->decimal('price', 10, 2);
            $table->string('border_color');
            $table->string('set_quantity',64);
            $table->text('desc');
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
        Schema::dropIfExists('products');
    }
}
