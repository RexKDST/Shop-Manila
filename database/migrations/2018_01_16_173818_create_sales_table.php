<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales',function (Blueprint $table) {
        $table->increments('id');
        $table->string('customer_name');
        $table->string('product_name');
        $table->integer('quantity');
        $table->string('address');
        $table->string('contact');
        $table->integer('sub_total');
        $table->string('mode');
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
        Schema::drop('sales');
    }
}
