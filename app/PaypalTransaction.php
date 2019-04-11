<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
            'paypal_payment_id', 'transaction_amount_currency', 'transaction_amount_details', 'transaction_amount_total',
            'item_list', 'related_resources'
    ];

    /**
     * Testing protected
     * @var array
     */
   /* protected $casts = [
        'item_list' => 'array',
        'related_resources' => 'array',
    ];*/

    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paypal_payment(){
        return $this->belongsTo(PaypalPayment::class, 'user_id','id');
    }

}
