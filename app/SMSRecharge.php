<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSRecharge extends Model
{
    protected $table = 'recharges_sms';
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
