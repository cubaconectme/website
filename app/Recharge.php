<?php

namespace App;

use App\Observers\RechargeObserver;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'recharge_type', 'recharge_type_id', 'user_id', 'contact_id','product_id','plan_id','promotion_id','payment_method','payment_id','status', 'follow_up_number'
    ];

    /**
     * Relation with contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(){
        return $this->belongsTo(Contact::class);
    }


    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the child relations
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function child(){
        return $this->morphTo(null,'recharge_type','recharge_type_id');
    }

    /**
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion(){
        return $this->belongsTo(Promotion::class);
    }

    /**
     * RKO Request BOOT method
     */
    public static function boot()
    {
        parent::boot();
        self::observe(new RechargeObserver());
    }
}
