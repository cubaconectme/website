<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/8/2019
 * Time: 7:18 PM
 */

namespace App\Http\Helper\CreateRecharges;


class NautaRecharge extends CreateRecharge
{

    /**
     * Init Recharge Type
     * @return mixed|void
     */
    public function init()
    {
        $this->recharge_type = \App\NautaRecharge::class;
        $this->initial = 'N';
    }

    /**
     * Create child Entity
     * @param $rech
     * @return bool
     */
    public function createChild($rech)
    {
        $nauta = \App\NautaRecharge::create([
            'email' => $rech['product_value']
        ]);

        return $nauta;
    }


}