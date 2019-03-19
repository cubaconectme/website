<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 2:57 PM
 */

namespace App\Http\Helper\DataFormatter\User;


use App\Http\Helper\DataFormatter\AbstractDataFormatter;

class UserFormatter extends AbstractDataFormatter
{

    /**
     * Set formatted data from object
     * @return array
     */
    protected function setFormattedData()
    {
       return [
           'user_id'        => $this->object->id,
           'name'           => $this->object->name,
           'email'          => $this->object->email,
           'notification'   => $this->object->notification,
           'image'          => ($this->object->profile_image) ? $this->object->profile_image : $this->createAdorableAvatar(),
           'password'       => $this->object->password,
           'roles'          => $this->getUSerRoles(),
           'deleted'         => ($this->object->deleted_at) ? 1 : 0
       ];
    }

    /**
     * Get all roles for this user
     * @return mixed
     */
    private function getUSerRoles(){
        return $this->object->roles->toArray('id', 'name');
    }

    /**
     * Get the Adorable icon
     * @return string
     */
    private function createAdorableAvatar(){
        return 'https://api.adorable.io/avatars/64/'.$this->object->id.'.png';
    }
}