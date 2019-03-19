<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'plan_id', 'name', 'description','status'
    ];

    /**
     * Has Many Recharges
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recharge(){
        return $this->hasMany(Recharge::class);
    }

    /**
     * Relation with Plan
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan(){
        return $this->belongsTo(Planes::class,'plan_id', 'id');
    }

}
