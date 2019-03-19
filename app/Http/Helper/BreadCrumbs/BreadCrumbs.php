<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/1/2019
 * Time: 6:03 PM
 */

namespace App\Http\Helper\BreadCrumbs;


use Illuminate\Support\Facades\URL;

abstract class BreadCrumbs
{
    protected $array_list;

    /**
     * BreadCrumbs constructor.
     */
    public function __construct()
    {
        $this->initBreadCrumbs();
    }

    /**
     * Init list of breadcrumbs
     */
    private function initBreadCrumbs(){
        $this->array_list[] = [
            'order' => 1,
            'label' => 'Dashboard',
            'link'  => URL::route('admin.index')
        ];
    }

    /**
     * Get the breadcrumbs Menu
     * @return mixed
     */
    public function getBreadCrumbs(){
        return $this->array_list;
    }

    /**
     * @param null $order
     * @param $label
     * @param $link
     * @return mixed
     */
    abstract public function addItemToBreadCrumbs($order  = null , $label, $link);


}