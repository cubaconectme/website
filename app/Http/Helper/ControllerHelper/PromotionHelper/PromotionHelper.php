<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/3/2019
 * Time: 9:40 AM
 */

namespace App\Http\Helper\ControllerHelper\PromotionHelper;

use App\Http\Helper\DataFormatter\Planes\PlanesFormatter;
use App\Http\Helper\DataFormatter\Promotion\PromotionFormatter;
use App\Planes;
use App\Product;
use App\Promotion;
use Illuminate\Http\Request;

class PromotionHelper
{
    public $promotion;

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
   private function createPromotion(){
        if(!$this->request->promotion_name || !$this->request->promotion_description) {
            return false;
        }
        $this->promotion = Promotion::create([
            'name' => $this->request->promotion_name,
            'description' => $this->request->promotion_description,
            'plan_id' => $this->request->plan_id,
            'status' => 'pending',
        ]);
        $this->promotion = new PromotionFormatter($this->promotion);
   }

    /**
     * Delete Products
     * @return bool
     */
   private function deletePromotion(){
       if(!$this->request->promotion_id) {
           return false;
       }
       $this->promotion = Promotion::find($this->request->promotion_id);
       if(!$this->promotion){
           return false;
       }
       $this->promotion->delete();

       $this->promotion = new PromotionFormatter($this->promotion);
   }

    /**
     * Edit Product Info
     * @return bool
     * TODO: no blank en ningun edit
     */
   private function editPromotion(){
       if(!$this->request->promotion_id) {
           return false;
       }

       $this->promotion =  Promotion::find($this->request->promotion_id);
       if(!$this->promotion){
           return false;
       }

       $this->promotion->name = $this->request->promotion_name;
       $this->promotion->description = $this->request->promotion_description;
       $this->promotion->plan_id = $this->request->plan_id;
       $this->promotion->save();
       $this->promotion = new PromotionFormatter($this->promotion);
   }

}