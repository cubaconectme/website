<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'product_id','balance'
    ];


    /**
     * Relation with Product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * Relation with Promotion
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function promotions(){
        return $this->hasMany(Promotion::class, 'plan_id','id');
    }
}
