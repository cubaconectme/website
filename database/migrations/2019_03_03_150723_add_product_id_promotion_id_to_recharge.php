<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductIdPromotionIdToRecharge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->integer('product_id')->after('contact_id');
            $table->integer('promotion_id')->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('promotion_id');
        });
    }
}
