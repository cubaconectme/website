<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/3/2019
 * Time: 9:40 AM
 */

namespace App\Http\Helper\ControllerHelper\PlanHelper;

use App\Http\Helper\DataFormatter\Planes\PlanesFormatter;
use App\Planes;
use App\Product;
use Illuminate\Http\Request;

class PlanHelper
{
    public $plan;

    private $request;

    private $user;

    private $method;

    /**
     * HomeHelper constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
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
        }

        return false;
    }

    /**
     * Create New Product
     * product_name: this.product_name,
     * product_description: this.product_description,
     */
   private function createPlan(){
        if(!$this->request->plan_name || !$this->request->plan_description) {
            return false;
        }
        $this->plan = Planes::create([
            'name' => $this->request->plan_name,
            'description' => $this->request->plan_description,
            'price' => $this->request->price,
            'product_id' => $this->request->product_id,
            'balance' => $this->request->balance,
        ]);
        $this->plan = new PlanesFormatter($this->plan);
   }

    /**
     * Delete Products
     * @return bool
     */
   private function deletePlan(){
       if(!$this->request->plan_id) {
           return false;
       }
       $this->plan = Planes::find($this->request->plan_id);
       if(!$this->plan){
           return false;
       }
       $this->plan->delete();

       $this->plan = new PlanesFormatter($this->plan);
   }

    /**
     * Edit Product Info
     * @return bool
     */
   private function editPlan(){
       if(!$this->request->plan_id) {
           return false;
       }

       $this->plan =  Planes::find($this->request->plan_id);
       if(!$this->plan){
           return false;
       }

       $this->plan->name = $this->request->plan_name;
       $this->plan->description = $this->request->plan_description;
       $this->plan->price = $this->request->price;
       $this->plan->balance = $this->request->balance;
       $this->plan->product_id = $this->request->product_id;
       $this->plan->save();
       $this->plan = new PlanesFormatter($this->plan);
   }

}