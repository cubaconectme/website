<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/21/2019
 * Time: 10:38 AM
 */

namespace App\Http\Helper\ControllerHelper\HomeHelper;

use App\Http\Helper\DataFormatter\Product\ProductFormatter;
use App\Planes;
use App\Product;
use Illuminate\Support\Facades\Auth;

class HomeViewHelper
{

    private $products;

    private $user;

    private $recharges;

    private $user_contacts;

    private $planes_cubacel;

    private $planes_nauta;

    /**
     * HomeViewHelper constructor.
     */
    public function __construct()
    {
        $this->products = $this->getProducts();
        if($this->authUser()) {
            $this->initData();
        }
    }

    /**
     * Get All products
     */
    private function getProducts(){
        $products = Product::with(['planes' => function($plan){
            $plan->with('promotions');
        }])->get();


        $products->transform(function($prod){
            return new ProductFormatter($prod);
        });
        return $products;
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
     */
    private function initData(){
        $this->initUser();
        $this->initRecharges();
        $this->initContacts();
        $this->initPlanesCubacel();
        $this->initPlanesNauta();
    }

    /**
     * Planes Cubacel
     */
    private function initPlanesCubacel(){
        $this->planes_cubacel = Planes::whereHas('product', function($prod){
            $prod->where('name','Cubacel');
        })->with(['product'])->get();
    }

    /**
     * Planes Nauta
     */
    private function initPlanesNauta(){
        $this->planes_nauta = Planes::whereHas('product', function($prod){
            $prod->where('name','Nauta');
        })->with(['product'])->get();
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
        $this->user = Auth::user();
        $this->user->load('recharge', 'contacts');
    }

    /**
     * Check if the user is logged
     */
    private function authUser(){
        return (Auth::check()) ? Auth::user() : null;
    }
}