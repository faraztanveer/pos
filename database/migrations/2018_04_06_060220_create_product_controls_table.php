<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productControls', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('product_id');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('quantity')->default('0');
            $table->string('colorPhoto')->default('noimage.jpg');
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
        Schema::dropIfExists('productControls');
    }
}
