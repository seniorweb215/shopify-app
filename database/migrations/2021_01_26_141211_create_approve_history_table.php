<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApproveHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approve_history', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('retailer_id');
            $table->float('approved_price');
            $table->integer('approved_quantity');
            $table->text('approved_description');
            $table->string('approved_tags');
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
        Schema::dropIfExists('approve_history');
    }
}
