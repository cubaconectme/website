<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 2:57 PM
 */

namespace App\Http\Helper\DataFormatter\Planes;


use App\Http\Helper\DataFormatter\AbstractDataFormatter;

class PlanesFormatter extends AbstractDataFormatter
{

    /**
     * Set formatted data from object
     * @return array
     */
    protected function setFormattedData()
    {
       return [
           'plan_id'            => $this->object->id,
           'name'               => $this->object->name,
           'description'        => $this->object->description,
           'price'              => $this->object->price,
           'balance'            => $this->object->balance,
           'is_selected'        => false,
           'product'            => ($this->object->product) ? $this->object->product->name : 'N/A',
           'product_id'         => ($this->object->product) ? $this->object->product->id : null,
       ];
    }

}