<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/8/2019
 * Time: 7:18 PM
 */

namespace App\Http\Helper\CreateRecharges;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class CubacelRecharge extends CreateRecharge
{

    /**
     * Init Recharge Type
     * @return mixed|void
     */
    public function init()
    {
        $this->recharge_type = \App\CubacelRecharge::class;
        $this->initial = 'C';
    }

    /**
     * We have to queue this function for delay responses
     * @param $rech
     */
    private function sendRechargeToDing($rech){
        $url = 'https://api.dingconnect.com/api/V1/SendTransfer';

        $data = [
            'SkuCode'    => 'CU_CU_TopUp',
            'SendValue'  =>  (int)$rech['price'],
            'SendCurrencyIso' => 'USD',
            'AccountNumber' => $rech['product_value'],
            'DistributorRef'=> 'Stay Connect',
            'ValidateOnly' =>  True
        ];

        $header = [
            "api_key:LFg2ydkqyU9634Qqa3iUyp",
            'Content-Type:application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $response = json_decode($response);
        dd($response);
        $error = curl_error($ch);
        curl_close($ch);

    }


    /**
     * Create child Entity
     * @param $rech
     * @return bool
     */
    public function createChild($rech)
    {
        $this->sendRechargeToDing($rech);
        $cubacel = \App\CubacelRecharge::create([
            'number' => $rech['product_value']
        ]);

        return $cubacel;
    }


}