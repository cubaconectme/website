<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'image', 'number', 'user_id'
    ];

    /**
     * Has Many Recharges
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recharge(){
        return $this->hasMany(Recharge::class);
    }

}
