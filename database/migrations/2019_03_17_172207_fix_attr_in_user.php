<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixAttrInUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('notification');
            $table->dropColumn('profile_image');
            $table->dropColumn('name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->after('email')->nullable();
            $table->tinyInteger('notification')->after('remember_token')->default(0);
            $table->string('profile_image')->after('notification')->nullable();
            $table->string('name')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('notification');
            $table->dropColumn('profile_image');
            $table->dropColumn('name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->after('email');
            $table->tinyInteger('notification')->after('remember_token');
            $table->string('profile_image')->after('notification');
            $table->string('name')->after('id');
        });
    }
}
