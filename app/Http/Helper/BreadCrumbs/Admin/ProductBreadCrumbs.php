<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 6:13 PM
 */

namespace App\Http\Helper\BreadCrumbs\Admin;


use App\Http\Helper\BreadCrumbs\BreadCrumbs;

class ProductBreadCrumbs extends BreadCrumbs
{
    /**
     * @param null $order
     * @param $label
     * @param $link
     */
    public function addItemToBreadCrumbs($order = null, $label, $link)
    {
        array_push($this->array_list,['order' => $order,'label' => $label, 'link' => $link]);
    }
}