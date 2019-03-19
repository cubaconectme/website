<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 2:57 PM
 */

namespace App\Http\Helper\DataFormatter\Promotion;


use App\Http\Helper\DataFormatter\AbstractDataFormatter;

class PromotionFormatter extends AbstractDataFormatter
{

    /**
     * Set formatted data from object
     * @return array
     */
    protected function setFormattedData()
    {
       return [
           'promotion_id'       => $this->object->id,
           'name'               => $this->object->name,
           'description'        => $this->object->description,
           'status'             => $this->object->status,
           'plan'               => ($this->object->plan) ? $this->object->plan->name : 'N/A',
           'plan_id'            => ($this->object->plan) ? $this->object->plan->id : null,
       ];
    }

}