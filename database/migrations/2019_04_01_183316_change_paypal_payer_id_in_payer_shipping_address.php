<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePaypalPayerIdInPayerShippingAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payer_shipping_address', function (Blueprint $table) {
            $table->dropColumn('paypal_payer_id');
        });
        Schema::table('payer_shipping_address', function (Blueprint $table) {
            $table->string('paypal_payer_id')->after('payer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payer_shipping_address', function (Blueprint $table) {
            $table->dropColumn('paypal_payer_id');
        });
        Schema::table('payer_shipping_address', function (Blueprint $table) {
            $table->integer('paypal_payer_id')->after('payer_id');
        });
    }
}
