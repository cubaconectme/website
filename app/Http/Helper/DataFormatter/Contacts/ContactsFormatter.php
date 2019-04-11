<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 2:57 PM
 */

namespace App\Http\Helper\DataFormatter\Contacts;


use App\Http\Helper\DataFormatter\AbstractDataFormatter;

class ContactsFormatter extends AbstractDataFormatter
{

    /**
     * Set formatted data from object
     * @return array
     */
    protected function setFormattedData()
    {
       return [
           'contact_id'     => $this->object->id,
           'name'           => $this->object->name,
           'email'          => $this->object->email,
           'image'          => $this->object->image,
           'number'         => $this->object->number
       ];
    }

}