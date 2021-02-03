<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('supplier_id');
            $table->text('description');
            $table->float('price');
            $table->string('SKU')->nullable();
            $table->integer('total_quantity');
            $table->integer('quantity');
            $table->float('weight');
            $table->float('shipping_cost');
            $table->string('file_name')->nullable();
            $table->text('file_path')->nullable();
            $table->integer('status');
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
