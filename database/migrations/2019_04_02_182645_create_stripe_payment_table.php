<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStripePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stripe_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('stripe_charge_id')->nullable();
            $table->string('stripe_object')->nullable();
            $table->string('amount')->nullable();
            $table->string('amount_refunded')->nullable();
            $table->string('application')->nullable();
            $table->string('application_fee')->nullable();
            $table->string('application_fee_amount')->nullable();
            $table->string('balance_transaction')->nullable();
            $table->string('billing_details')->nullable();
            $table->tinyInteger('capture')->nullable();
            $table->string('created')->nullable();
            $table->string('currency')->nullable();
            $table->string('customer')->nullable();
            $table->text('description')->nullable();
            $table->string('destination')->nullable();
            $table->string('dispute')->nullable();
            $table->string('failure_code')->nullable();
            $table->string('failure_message')->nullable();
            $table->string('fraud_details')->nullable();
            $table->string('invoice')->nullable();
            $table->tinyInteger('livemode')->nullable();
            $table->string('metadata')->nullable();
            $table->string('on_behalf_of')->nullable();
            $table->string('order')->nullable();
            $table->string('outcome')->nullable();
            $table->tinyInteger('paid')->nullable();
            $table->string('payment_intent')->nullable();
            $table->text('payment_method_details')->nullable();
            $table->string('receipt_email')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('receipt_url')->nullable();
            $table->string('refunded')->nullable();
            $table->string('refunds')->nullable();
            $table->string('review')->nullable();
            $table->text('shipping')->nullable();
            $table->text('source')->nullable();
            $table->string('source_transfer')->nullable();
            $table->string('statement_descriptor')->nullable();
            $table->string('status')->nullable();
            $table->string('transfer_data')->nullable();
            $table->string('transfer_group')->nullable();
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
        Schema::dropIfExists('stripe_payment');
    }
}
