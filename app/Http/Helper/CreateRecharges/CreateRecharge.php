<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/8/2019
 * Time: 7:03 PM
 */

namespace App\Http\Helper\CreateRecharges;


use App\Promotion;
use App\Recharge;

abstract class CreateRecharge
{
    protected $payment_method;

    protected $payment_id;

    protected $user;

    protected $request;

    protected $recharges;

    protected $recharge_type;


    protected $initial;

    /**
     * Function to init data in the child
     * @return mixed
     */
    abstract protected function init();
    abstract protected function createChild($rech);

    /**
     * Get Recharges
     * @return mixed
     */
    public function getRecharges(){
        return $this->recharges;
    }

    /**
     * CreateRecharge constructor.
     * @param $payment_method
     * @param $payment_id
     * @param $user
     * @param $request
     */
    public function __construct($payment_method, $payment_id, $user, $request)
    {
        $this->payment_method = $payment_method;
        $this->payment_id = $payment_id;
        $this->user = $user;
        $this->request = $request;
        $this->init();
    }

    /**
     * Create Generic/Parent Recharge
     * @param $recharge_type
     * @param $recharge_type_id
     * @param $initial
     * @return bool
     */
    public function createRecharge(){
        if(count($this->request->recharges)){
            foreach($this->request->recharges as $rech){
                $child = $this->createChild($rech);
                $this->recharges[] = Recharge::create([
                    'recharge_type' => $this->recharge_type,
                    'recharge_type_id'  => $child->id,
                    'user_id'       => $this->user->id,
                    'contact_id'    => (isset($rech['contact_id'])) ? $rech['contact_id'] : 0,
                    'product_id'    => $rech['product_id'],
                    'plan_id'       => $rech['plan_id'],
                    'promotion_id'  => $this->getPromotionId($rech['plan_id']),
                    'payment_method'=> $this->payment_method,
                    'payment_id'    => $this->payment_id,
                    'status'        => 'pending',
                    'follow_up_number' => $this->createFollowUpNumber($this->initial)
                ]);
            }
        }

        return true;
    }

    /**
     * Get the unique follow up number
     * @param $initial
     * @return string
     */
    private function createFollowUpNumber($initial){
        $number = strtoupper($initial.uniqid ("" ,true ));
        $number = substr($number,0,10);
        $number_in_recharges = Recharge::where('follow_up_number',$number)->count();
        if($number_in_recharges){
            $this->createFollowUpNumber($initial);
        } else {
            return $number;
        }
    }

    /**
     * Get the promotion for this plan
     *
     * @param $plan_id
     * @return int
     */
    private function getPromotionId($plan_id){
        $promotion = Promotion::where('plan_id',$plan_id)->where('status', 'active')->first();
        if(!$promotion){
            return 0;
        }
        return $promotion->id;
    }

}