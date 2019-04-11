<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/2/2019
 * Time: 2:20 PM
 */

namespace App\Http\Helper\ControllerHelper\RechargesHelpers\Payments;


use App\StripePayment;

class StripePaymentHandle
{
    private $stripe_response;

    private $user;

    public $has_error;

    public $error_message;

    public $stripe_payment_id;

    /**
     * StripePaymentHandle constructor.
     * @param $stripe_response
     * @param $user
     * @throws \Exception
     */
    public function __construct($stripe_response, $user)
    {
        $this->stripe_response = $stripe_response;
        $this->user = $user;
        $this->initPayment();
    }


    /**
     * @throws \Exception
     */
    private function initPayment(){
        if($this->stripe_response['status'] != 'succeeded'){
            throw new \Exception('Tarjeta rechazada');
        }
        return $this->saveStripePayment();
    }
    private function saveStripePayment(){
        //dd($this->stripe_response);
        $stripe_payment = StripePayment::create([
            'user_id'                   => $this->user->id,
            'stripe_charge_id'          => $this->stripe_response['id'],
            'stripe_object'             => json_encode($this->stripe_response['object']),
            'amount'                    => $this->stripe_response['amount'],
            'amount_refunded'           => $this->stripe_response['amount_refunded'],
            'application'               => $this->stripe_response['application'],
            'application_fee'           => $this->stripe_response['application_fee'],
            'application_fee_amount'    => $this->stripe_response['application_fee_amount'],
            'balance_transaction'       => $this->stripe_response['balance_transaction'],
            'billing_details'           => json_encode($this->stripe_response['billing_details']),
            'capture'                   => $this->stripe_response['capture'],
            'created'                   => $this->stripe_response['created'],
            'currency'                  => $this->stripe_response['currency'],
            'customer'                  => $this->stripe_response['customer'],
            'description'               => $this->stripe_response['description'],
            'destination'               => $this->stripe_response['destination'],
            'dispute'                   => $this->stripe_response['dispute'],
            'failure_code'              => $this->stripe_response['failure_code'],
            'failure_message'           => $this->stripe_response['failure_message'],
            'fraud_details'             => json_encode($this->stripe_response['fraud_details']),
            'invoice'                   => $this->stripe_response['invoice'],
            'livemode'                  => $this->stripe_response['livemode'],
            'metadata'                  => json_encode($this->stripe_response['metadata']),
            'on_behalf_of'              => $this->stripe_response['on_behalf_of'],
            'order'                     => $this->stripe_response['order'],
            'outcome'                   => json_encode($this->stripe_response['outcome']),
            'paid'                      => $this->stripe_response['paid'],
            'payment_intent'            => $this->stripe_response['payment_intent'],
            'payment_method_details'    => json_encode($this->stripe_response['payment_method_details']),
            'receipt_email'             => $this->stripe_response['receipt_email'],
            'receipt_number'            => $this->stripe_response['receipt_number'],
            'receipt_url'               => $this->stripe_response['receipt_url'],
            'refunded'                  => $this->stripe_response['refunded'],
            'refunds'                   => json_encode($this->stripe_response['refunds']),
            'review'                    => $this->stripe_response['review'],
            'shipping'                  => json_encode($this->stripe_response['source']),
            'source'                    => $this->stripe_response['payment_method_details'],
            'source_transfer'           => $this->stripe_response['source_transfer'],
            'statement_descriptor'      => $this->stripe_response['statement_descriptor'],
            'status'                    => $this->stripe_response['status'],
            'transfer_data'             => $this->stripe_response['transfer_data'],
            'transfer_group'            => $this->stripe_response['transfer_group']
        ]);

        if(!$stripe_payment){
            throw new \Exception('Error al crear el pago');
        }
        $this->stripe_payment_id = $stripe_payment->id;
        return true;
    }

}