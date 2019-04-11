<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'notification', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship with roles table to see all roles for this user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * User relation withs her paypal payments
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paypal_payments(){
        return $this->hasMany(PaypalPayment::class);
    }

    /**
     * Relation with paypal payer
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paypal_payer(){
        return $this->hasMany(PaypalPayer::class);
    }


    /**
     * @param $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Get the roles name array
     * @return array
     */
    public function getRolesArray(){
        $roles = [];
        $this->roles->each(function($rol) use (&$roles){
            $roles[] = ['rol' => $rol->name];
        });
        return $roles;
    }

    /**
     * Relation with recharges
     */
    public function recharge(){
        return $this->hasMany(Recharge::class,'user_id','id');
    }

    /**
     * Relation with recharges
     */
    public function contacts(){
        return $this->hasMany(Contact::class,'user_id','id');
    }

}
