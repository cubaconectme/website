<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixImageAndUserIdInContacs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('email');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
            $table->string('image')->after('name')->nullable();
            $table->string('email')->after('image')->nullable();
            $table->integer('user_id')->after('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('email');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->string('name');
            $table->string('image');
            $table->string('email');
            $table->integer('user_id');
        });

    }
}
