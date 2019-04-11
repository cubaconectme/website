<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayerShippingAddress extends Model
{
    protected $table = 'payer_shipping_address';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'payer_id', 'paypal_payer_id', 'city', 'country_code', 'line1', 'line2', 'postal_code', 'recipient_name', 'state'
    ];

    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    /**
     * Relation with paypal payments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paypal_payment(){
        return $this->hasMany(PaypalPayment::class);
    }

}
