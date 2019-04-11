<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalPayer extends Model
{
    protected $table = 'paypal_payer';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id', 'country_code', 'email', 'first_name', 'last_name', 'middle_name', 'payer_id', 'payment_method', 'status'
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
