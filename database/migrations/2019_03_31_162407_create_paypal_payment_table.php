<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypalPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('cart');
            $table->string('create_time');
            $table->string('paypal_id');
            $table->string('intent');
            $table->string('state');
            $table->integer('paypal_payer_id');
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
        Schema::dropIfExists('paypal_payment');
    }
}
