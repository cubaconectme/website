<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/1/2019
 * Time: 11:34 AM
 */
namespace App\Http\Helper\ControllerHelper\RechargesHelpers\Payments;


use App\PayerShippingAddress;
use App\PaypalPayer;
use App\PaypalPayment;
use App\PaypalTransaction;

class PaypalPaymentHandle
{
    private $paypal_response;

    private $user;

    public $has_error;

    public $error_message;

    public $paypal_payment_id;

    /**
     * PaypalPayment constructor.
     * @param $paypal_response
     * @param $user
     * @throws \Exception
     */
    public function __construct($paypal_response, $user)
    {
        $this->paypal_response = $paypal_response;
        $this->user = $user;
        $this->initPayment();
    }

    /**
     * @throws \Exception
     */
    private function initPayment(){
        if($this->paypal_response['state'] != 'approved'){
            throw new \Exception('Pago de paypal rechazado');
        }
        return $this->savePaypalPayment();
    }

    /**
     * Save Paypal Payment
     * @throws \Exception
     */
    private function savePaypalPayment(){
        $paypal_payment = PaypalPayment::create([
            'user_id'           => $this->user->id,
            'cart'              => $this->paypal_response['cart'],
            'create_time'       => $this->paypal_response['create_time'],
            'paypal_id'         => $this->paypal_response['id'],
            'intent'            => $this->paypal_response['intent'],
            'state'             => $this->paypal_response['state'],
            'paypal_payer_id'   => ($this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['payer_id'] : 'N/A'
        ]);
        if(!$paypal_payment){
            throw new \Exception('Error al crear el pago');
        }
        $this->paypal_payment_id = $paypal_payment->id;
        return $this->savePayerData($paypal_payment);
    }

    /**
     * Save payer data
     * @return mixed
     * @throws \Exception
     */
    private function savePayerData($paypal_payment){
        $payer_data = PaypalPayer::create([
            'user_id'           => $this->user->id,
            'country_code'      => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['country_code'] : 'N/A',
            'email'             => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['email'] : 'N/A',
            'first_name'        => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['first_name'] : 'N/A',
            'last_name'         => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['last_name'] : 'N/A',
            'middle_name'       => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['middle_name'] : 'N/A',
            'payer_id'          => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'])
                                    ? $this->paypal_response['payer']['payer_info']['payer_id'] : 'N/A',
            'payment_method'    => ($this->paypal_response && $this->paypal_response['payer'])
                                    ? $this->paypal_response['payer']['payment_method'] : 'N/A',
            'status'            => ($this->paypal_response && $this->paypal_response['payer'])
                                    ? $this->paypal_response['payer']['status'] : 'N/A',
        ]);

        if(!$payer_data){
            throw new \Exception('Error al crear el la data del payer');
        }
        return $this->savePayerShippingAddress($payer_data,$paypal_payment);
    }

    /**
     * @param $payer_data
     * @return mixed
     * @throws \Exception
     */
    private function savePayerShippingAddress($payer_data,$paypal_payment){
        //TODO: Revisar si existe
        $payer_shipping_address = PayerShippingAddress::create([
            'payer_id'              => $payer_data->id,
            'paypal_payer_id'       => ($this->paypal_response && $this->paypal_response['payer']&& $this->paypal_response['payer']['payer_info'])
                                         ? $this->paypal_response['payer']['payer_info']['payer_id'] : 'N/A',
            'city'                  => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'])
                                         ? $this->paypal_response['payer']['payer_info']['shipping_address']['city'] : 'N/A',
            'country_code'          => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'])
                                         ? $this->paypal_response['payer']['payer_info']['shipping_address']['country_code'] : 'N/A',
            'line1'                 => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'])
                                         ? $this->paypal_response['payer']['payer_info']['shipping_address']['line1'] : 'N/A',
            'line2'                 => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'] && isset($this->paypal_response['payer']['payer_info']['shipping_address']['line2']))
                                         ? $this->paypal_response['payer']['payer_info']['shipping_address']['line2'] : '',
            'postal_code'           => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'])
                                         ? $this->paypal_response['payer']['payer_info']['shipping_address']['postal_code'] : 'N/A',
            'recipient_name'        => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'])
                                         ? $this->paypal_response['payer']['payer_info']['shipping_address']['recipient_name'] : 'N/A',
            'state'                 => ($this->paypal_response && $this->paypal_response['payer'] && $this->paypal_response['payer']['payer_info'] && $this->paypal_response['payer']['payer_info']['shipping_address'])
                                        ? $this->paypal_response['payer']['payer_info']['shipping_address']['state'] : 'N/A',
        ]);
        if(!$payer_shipping_address){
            throw new \Exception('Error al crear el la shipping address del payer');
        }
        return $this->savePaypalTransaction($payer_shipping_address,$paypal_payment);//TODO: save paypal transaction

    }

    /**
     * Create Paypal Transaction
     * @param $payer_shipping_address
     * @param $paypal_payment
     * @return bool
     */
    private function savePaypalTransaction($payer_shipping_address,$paypal_payment){
        $all_transactions = [];
        if($this->paypal_response && $this->paypal_response['transactions']){
            if(count($this->paypal_response['transactions'])){
                foreach ($this->paypal_response['transactions'] as $trans){
                    $all_transactions[] = PaypalTransaction::create([
                        'paypal_payment_id'             => $paypal_payment->id  ,
                        'transaction_amount_currency'   => $trans['amount']['currency'],
                        'transaction_amount_details'    => json_encode($trans['amount']['details']),
                        'transaction_amount_total'      => $trans['amount']['total'],
                        'item_list'                     => json_encode($trans['item_list']),
                        'related_resources'             => json_encode($trans['related_resources'])
                    ]);
                }
            }
        }
        if(!count($all_transactions)){
            return false;
        }
        //TODO: save transaction data
        return true;
    }
}