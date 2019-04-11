<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePaypalPayerIdToStringPaypalPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paypal_payment', function (Blueprint $table) {
            $table->dropColumn('paypal_payer_id');
        });
        Schema::table('paypal_payment', function (Blueprint $table) {
            $table->string('paypal_payer_id')->after('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paypal_payment', function (Blueprint $table) {
            $table->dropColumn('paypal_payer_id');
        });
        Schema::table('paypal_payment', function (Blueprint $table) {
            $table->integer('paypal_payer_id')->after('state');
        });
    }
}
