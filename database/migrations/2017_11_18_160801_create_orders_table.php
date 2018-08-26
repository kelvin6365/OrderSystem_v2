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
            $table->increments('id');
            $table->string('order_code');
            $table->string('c_name');
            $table->string('email');
            $table->integer('phone_no');
            $table->string('adress');
            $table->string('type_total');
            $table->string('c_option');
            $table->integer('order_paystate');
            $table->integer('order_state');
            $table->string('order_handle');
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
