<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalPayment extends Model
{
    protected $table = 'paypal_payment';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'cart', 'create_time', 'paypal_id', 'intent', 'state', 'paypal_payer_id'
    ];

    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    /**
     * Relation with paypal payer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paypal_payer(){
        return $this->belongsTo(PaypalPayer::class);
    }

    /**
     * RElation with transaction
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paypal_transaction(){
        return $this->hasMany(PaypalTransaction::class);
    }
}
