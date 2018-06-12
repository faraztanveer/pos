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
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('cat_id');
            $table->integer('genCat_id');
            $table->integer('admin_id');
            $table->integer('brand_id');
            $table->float('base_price', 11, 2)->default(0);
            $table->longText('note')->nullable();
            $table->boolean('productAvailability')->default(1);
            $table->boolean('featured')->default(0);
            $table->integer('quantity')->default(0);
            $table->boolean('hide')->default(0);
            $table->integer('tax')->default(0);
            $table->float('currentPrice',11,2)->default(0);
            $table->integer('currentRatting')->default(5);
            $table->string('general_photo')->default('noimage.jpg');
            $table->boolean('availability')->default(1);
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
