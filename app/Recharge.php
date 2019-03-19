<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'number', 'user_id', 'contact_id'
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
     * Relation with user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion(){
        return $this->belongsTo(Promotion::class);
    }
}
