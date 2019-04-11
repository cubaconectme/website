<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recharges', function (Blueprint $table) {
            $table->dropColumn('number');
        });
        Schema::table('recharges', function (Blueprint $table) {
            $table->string('recharge_type')->after('id');
            $table->integer('recharge_type_id')->after('recharge_type');
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
            $table->dropColumn('recharge_type');
            $table->dropColumn('recharge_type_id');
        });
        Schema::table('recharges', function (Blueprint $table) {
            $table->string('number')->after('id');
        });
    }
}
