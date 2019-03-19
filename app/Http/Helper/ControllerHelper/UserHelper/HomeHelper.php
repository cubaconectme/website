<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/3/2019
 * Time: 9:40 AM
 */

namespace App\Http\Helper\ControllerHelper\UserHelper;

use App\Product;
use App\Recharge;
use Illuminate\Http\Request;

class HomeHelper
{
    private $user;

    private $last_recharges;

    private $products;

    private $request;

    /**
     * HomeHelper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = $this->request->user();
        $this->init();
    }


    private function init(){
        $this->initLastRecharges();
    }

    /**
     * Init last recharges by user and products
     */
    private function initLastRecharges(){
        $this->products = Product::with(['recharge' => function($re){
            $re->with(['plan','contact','promotion'])->where('user_id',$this->user->id);
        }])->get();
    }

    /**
     * Return this class to Array
     * @return array
     */
    public function toArray(){
        return [
            'products' => $this->products
        ];
    }
}