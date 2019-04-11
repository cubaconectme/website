<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/3/2019
 * Time: 9:40 AM
 */

namespace App\Http\Helper\ControllerHelper\RechargesHelpers;

use App\Http\Helper\ControllerHelper\RechargesHelpers\Payments\PaypalPaymentHandle;
use App\Http\Helper\ControllerHelper\RechargesHelpers\Payments\StripePaymentHandle;
use App\Http\Helper\CreateRecharges\CubacelRecharge;
use App\Http\Helper\CreateRecharges\NautaRecharge;
use App\Http\Helper\CreateRecharges\SMSRecharge;
use App\Planes;
use App\Product;
use App\Promotion;
use App\Recharge;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

class RechargesHelper
{
    public $recharges;

    private $request;

    private $user;

    private $method;

    private $payment;

    public $contact;

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
     * Do actions
     * @return bool
     */
    private function init(){
        if(method_exists($this,$this->method)){
            return $this->{$this->method}();
        }

        return false;
    }

    /**
     * Pay with card
     */
    private function payWithCard(){
        $amount = $this->calculateAmount();
        Stripe::setApiKey(env('STRIPE_SECRET','sk_test_sGC9OI08jEKVHgOMXARKFR7o'));
        $charge_card = Charge::create ([
            "amount" => $amount,
            "currency" => "usd",
            "source" => $this->request->card_response['id'],
            "description" => "Test payment from cubaconnect.com."
        ]);

        if($payment = new StripePaymentHandle($charge_card,$this->user)){
            return $this->createRecharge($payment->stripe_payment_id,'stripe');
        }
        return false;
    }

    /**
     * Calculate Amount
     * @return float|int
     */
    private function calculateAmount(){
        $amount = 0;
        if(count($this->request->recharges)){
            foreach ($this->request->recharges as $rech){
                $recharge = Planes::find($rech['plan_id']);
                $amount += (float)$recharge->price;
            }
        }

        return $amount * 100;
    }

    /**
     * Handle Paypal payment
     * @return bool
     */
    private function payWithPaypal(){
        if($this->request->paypal_response['state'] != 'approved'){
            return false;
        }
        if($payment = $this->savePaypalPayment()){
            return $this->createRecharge($payment->paypal_payment_id,'paypal');
        }
        return false;
    }


    /**
     * Create New Recharge
     * @param $payment_id
     * @return bool
     */
    private function createRecharge($payment_id,$method){
        switch ($this->request->type){
            case('Cubacel'):
                $recharge = new CubacelRecharge($method,$payment_id,$this->user,$this->request);
                break;
            case('Nauta'):
                $recharge = new NautaRecharge($method,$payment_id,$this->user,$this->request);
                break;
            default:
                $recharge = new SMSRecharge($method,$payment_id,$this->user,$this->request);
        }
        $recharge->createRecharge();
        $this->recharges = $recharge->getRecharges();
        $this->contact = $this->getContact();
        return true;
    }

    /**
     * Init Contact
     * @return mixed
     */
    private function getContact(){
        $this->recharges[0]->load('contact');
        return $this->recharges[0]->contact;
    }

    /**
     * Get the unique follow up number
     * @param $product_id
     * @return string
     */
    private function createFollowUpNumber($product_id){
        $product_name = Product::find($product_id);
        $number = strtoupper($product_name->name[0].uniqid ("" ,true ));
        $number = substr($number,0,10);
        $number_in_recharges = Recharge::where('follow_up_number',$number)->count();
        if($number_in_recharges){
            $this->createFollowUpNumber($product_id);
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

    /**
     * @return PaypalPaymentHandle|bool
     * @throws \Exception
     */
    private function savePaypalPayment(){
        if($this->request->paypal_response){
            try{
                return new PaypalPaymentHandle($this->request->paypal_response,$this->user);
            } catch(\Exception $e){
                dd($e->getMessage());
                throw new \Exception($e->getMessage());
            }
        }
        return false;
    }
}