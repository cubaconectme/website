<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/21/2019
 * Time: 10:38 AM
 */

namespace App\Http\Helper\ControllerHelper\UserHelper;

use App\Planes;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginHelper
{
    private $request;

    private $login_type;

    private $user;

    private $recharges;

    private $user_contacts;

    private $planes_cubacel;

    private $planes_nauta;

    /**
     * UserLoginHelper constructor.
     * @param Request $request
     * @throws \Exception
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->login_type = (filter_var($this->request->username, FILTER_VALIDATE_EMAIL)) ? 'email' : 'phone_number';
        if($this->authUser()) {
            $this->initData();
        } else {
            throw new \Exception('Invalid Credentials');
        }
    }

    /**
     * Convert this object to array
     * @return array
     */
    public function toArray(){
        return get_object_vars($this);
    }


    /**
     * Init Necessary data
     * @throws \Exception
     */
    private function initData(){
        $this->initUser();
        if(!$this->user){
            throw new \Exception('Wrong User Credentials');
        }
        $this->initRecharges();
        $this->initContacts();
        $this->initPlanesCubacel();
        $this->initPlanesNauta();
    }

    /**
     * Planes Cubacel
     */
    private function initPlanesCubacel(){
        $this->planes_cubacel = Planes::with(['product' => function($prod){
            $prod->where('name','Cubacel');
        }])->get();
    }

    /**
     * Planes Nauta
     */
    private function initPlanesNauta(){
        $this->planes_nauta = Planes::with(['product' => function($prod){
            $prod->where('name','Nauta');
        }])->get();
    }

    /**
     * Init User Contacts
     */
    private function initContacts(){
        $this->user_contacts = $this->user->contacts;
    }

    /**
     * Init User Recharges
     */
    private function initRecharges(){
        $this->recharges =  $this->user->recharge;
    }

    /**
     * Init user logged
     */
    private function initUser(){
        $query = User::with('recharge', 'contacts');
        if($this->login_type === 'email') {
            $query = $query->where('email', $this->request->username);
        } else {
            $query = $query->where('phone_number', $this->request->username);
        }
        $this->user = $query->first();
    }

    /**
     *
     * @throws \Exception
     */
    private function authUser(){
        if(!$this->validateUserRequest()){
            throw new \Exception('Invalid Request');
        }
        if($this->login_type == 'email'){
          return $this->authByEmail();
        } else {
          return $this->authByPhone();
        }
    }

    /**
     * Auth user by email
     * @return bool
     */
    private function authByEmail(){
        return  Auth::attempt(['email' => $this->request->username, 'password' => $this->request->password], $this->request->remember_me);
    }

    /**
     * Auth user by Phone Number
     * @return bool
     */
    private function authByPhone(){
        return  Auth::attempt(['phone_number' => $this->request->username, 'password' => $this->request->password], $this->request->remember_me);
    }

    /**
     * @return bool
     */
    private function validateUserRequest(){
        if(!$this->request->username || !$this->request->password){
            return false;
        }

        return true;
    }

}