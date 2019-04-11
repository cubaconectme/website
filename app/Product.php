<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'description','product_placeholder', 'image_url'
    ];

    /**
     * Has Many Recharges
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recharge(){
        return $this->hasMany(Recharge::class);
    }

    /**
     * Relation with planes
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function planes(){
        return $this->hasMany(Planes::class, 'product_id','id');
    }

}
