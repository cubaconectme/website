<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentMethodToRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->string('payment_method')->after('plan_id');
            $table->integer('payment_id')->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_id');
        });
    }
}
