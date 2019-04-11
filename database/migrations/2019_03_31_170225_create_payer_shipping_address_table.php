<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayerShippingAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payer_shipping_address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payer_id');
            $table->integer('paypal_payer_id');
            $table->string('city');
            $table->string('country_code');
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('postal_code');
            $table->string('recipient_name');
            $table->string('state');
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
        Schema::dropIfExists('payer_shipping_address');
    }
}
