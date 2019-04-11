<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/8/2019
 * Time: 7:18 PM
 */

namespace App\Http\Helper\CreateRecharges;



class SMSRecharge extends CreateRecharge
{

    /**
     * Init Recharge Type
     * @return mixed|void
     */
    public function init()
    {
        $this->recharge_type = \App\SMSRecharge::class;
        $this->initial = 'S';
    }

    /**
     * Create child Entity
     * @param $rech
     * @return bool
     */
    public function createChild($rech)
    {
        $sms = \App\SMSRecharge::create([
            'number' => $rech['product_value']
        ]);

        return $sms;
    }


}