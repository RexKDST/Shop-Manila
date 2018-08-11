<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_info',function (Blueprint $table) {
        $table->increments('id');
        $table->string('stock_name');
        $table->string('stock_code');
        $table->string('buying_price');
        $table->string('selling_price');
        $table->string('supplier');
        $table->integer('cat_id');
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
         Schema::drop('stock_info');
    }
}
