<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNamePriceInProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('description')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('name')->after('id');
            $table->integer('description')->after('name');
        });
    }
}
