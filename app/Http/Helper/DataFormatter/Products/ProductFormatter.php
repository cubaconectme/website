<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 2:57 PM
 */

namespace App\Http\Helper\DataFormatter\Product;


use App\Http\Helper\DataFormatter\AbstractDataFormatter;
use App\Http\Helper\DataFormatter\Planes\PlanesFormatter;

class ProductFormatter extends AbstractDataFormatter
{

    /**
     * Set formatted data from object
     * @return array
     */
    protected function setFormattedData()
    {
       return [
           'product_id'                 => $this->object->id,
           'name'                       => $this->object->name,
           'description'                => $this->object->description,
           'image_url'                  => $this->object->image_url,
           'product_placeholder'        => $this->object->product_placeholder,
           'planes'                     => $this->getPlanes()
       ];
    }

    /**
     * Get planes formatter
     * @return array
     */
    private function getPlanes(){
        $planes_aux = [];
        if($this->object->planes->count()){
            $this->object->planes->each(function($plan) use(&$planes_aux){
                $planes_aux[] = new PlanesFormatter($plan);
            });
        }

        return $planes_aux;
    }
}