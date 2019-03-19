<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/3/2019
 * Time: 9:40 AM
 */

namespace App\Http\Helper\ControllerHelper\UserHelper;

use App\Http\Helper\DataFormatter\Planes\PlanesFormatter;
use App\Http\Helper\DataFormatter\User\UserFormatter;
use App\Planes;
use App\Product;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserHelper
{
    public $user_edited;

    private $request;

    private $user;

    private $method;

    public $has_error;

    public $error_message;

    /**
     * HomeHelper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->has_error = false;
        $this->error_message = 'Action was successfully';
        $this->request = $request;
        $this->method = $this->request->action_type;
        $this->user = $this->request->user();
        $this->init();
    }

    /**
     * Init Actions
     * @return bool
     */
    private function init(){
        if(method_exists($this,$this->method)){
            return $this->{$this->method}();
        } else {
            $this->has_error = true;
            $this->error_message = 'Action does not exist!!!';
            return $this;
        }
    }

    /**
     * Create New Product
     * product_name: this.product_name,
     * product_description: this.product_description,
     */
   private function updateRol(){
        if(!$this->request->user || !$this->request->roles) {
            return false;
        }
        $user = User::with('roles')->find($this->request->user);

        if(!$user){
            return false;
        }
        $user->roles()->detach();
        $user->roles()->attach($this->request->roles);
        $this->user_edited = new UserFormatter($user);
   }

    /**
     * Update Notification user
     * @return bool
     */
   private function updateUserNotification(){
       if(!$this->request->user || !$this->request->notification) {
           return false;
       }
       $user = User::find($this->request->user);

       if(!$user){
           return false;
       }
       $user->notification = $this->request->notification;
       $user->save();
       $this->user_edited = new UserFormatter($user);
   }

    /**
     * Create new User
     * @return $this
     */
   private function createUser(){
       if(!$this->request->user_email || !$this->request->user_name || !$this->request->user_password) {
           $this->has_error = true;
           $this->error_message = 'Wrong request, please fix and try again!!!';
           return $this;
       }

       $user = User::where('email', $this->request->user_email)->first();
       if($user){
           $this->has_error = true;
           $this->error_message = 'That user already exist!!!';
           return $this;
       }

       $user = User::create([
           'name'           => $this->request->user_name,
           'email'          => $this->request->user_email,
           'password'       => bcrypt($this->request->user_password),
           'notification'   => 1,
           'profile_image'  => ''
       ]);
       $rol = Role::where('name', 'customer')->first();
       $user->roles()->attach($rol);

       $this->error_message = 'User added successfully';
       $this->user_edited = new UserFormatter($user);
   }

    /**
     * Delete User
     * @return $this
     */
   private function deleteUser(){
       if(!$this->request->user_id){
           $this->has_error = true;
           $this->error_message = 'Wrong request, please fix and try again!!!';
           return $this;
       }

       $user = User::find($this->request->user_id);
       if(!$user){
           $this->has_error = true;
           $this->error_message = 'We can\'t find this user in our database';
           return $this;
       }

       $user->delete();
       $this->error_message = 'User deleted successfully';
       $this->user_edited = new UserFormatter($user);

   }

    /**
     * Un delete user
     * @return $this
     */
   private function unDeleteUser(){
       if(!$this->request->user_id){
           $this->has_error = true;
           $this->error_message = 'Wrong request, please fix and try again!!!';
           return $this;
       }

       $user = User::withTrashed()->find($this->request->user_id);
       if(!$user){
           $this->has_error = true;
           $this->error_message = 'We can\'t find this user in our database';
           return $this;
       }

       $user->restore();
       $this->error_message = 'User was un deleted successfully';
       $this->user_edited = new UserFormatter($user);
   }

}