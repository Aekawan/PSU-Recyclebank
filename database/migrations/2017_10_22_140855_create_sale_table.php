<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('garbage_id')->unsigned();
            $table->foreign('garbage_id')->references('id')->on('garbages');
            $table->double('purchase_price',7,2);
            $table->double('unit',7,2);
            $table->double('sale_price',7,2);
            $table->double('profit',7,2);
            $table->double('loss',7,2);
            $table->date('dateofsale');
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
        Schema::dropIfExists('sale');
    }
}
