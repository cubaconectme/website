<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    protected $table = 'stripe_payment';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'stripe_charge_id', 'stripe_object', 'amount', 'amount_refunded', 'application', 'application_fee',
        'application_fee_amount', 'balance_transaction', 'billing_details', 'capture', 'created', 'currency', 'customer',
        'description', 'destination', 'dispute', 'failure_code', 'failure_message', 'fraud_details', 'invoice', 'livemode',
        'metadata', 'on_behalf_of', 'order', 'outcome', 'paid', 'payment_intent', 'payment_method_details', 'receipt_email',
        'receipt_number', 'receipt_url', 'refunded', 'refunds', 'review', 'shipping', 'source', 'source_transfer',
        'statement_descriptor', 'status', 'transfer_data', 'transfer_group'
    ];
}
