<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeItemListInPaypalTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paypal_transactions', function (Blueprint $table) {
            $table->dropColumn('item_list');
            $table->dropColumn('related_resources');
        });

        Schema::table('paypal_transactions', function (Blueprint $table) {
            $table->text('item_list')->after('transaction_amount_total')->nullable();
            $table->text('related_resources')->after('item_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paypal_transactions', function (Blueprint $table) {
            $table->dropColumn('item_list');
            $table->dropColumn('related_resources');
        });

        Schema::table('paypal_transactions', function (Blueprint $table) {
            $table->string('item_list')->after('transaction_amount_total')->nullable();
            $table->string('related_resources')->after('item_list')->nullable();
        });
    }
}
