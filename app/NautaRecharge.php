<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NautaRecharge extends Model
{
    protected $table = 'recharges_nauta';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'email',
    ];

    /**
     * Relation with contact
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recharge(){
        return $this->belongsTo(Recharge::class);
    }

}
