<?php

namespace App;

use App\Observers\RechargeObserver;
use Illuminate\Database\Eloquent\Model;

class CubacelRecharge extends Model
{
    protected $table = 'recharges_cubacel';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'number',
    ];

    /**
     * Relation with contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recharge(){
        return $this->belongsTo(Recharge::class);
    }

}
