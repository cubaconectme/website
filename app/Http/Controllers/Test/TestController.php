<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Helper\BreadCrumbs\Admin\UserBreadCrumbs;
use App\Http\Helper\ControllerHelper\UserHelper\UserHelper;
use App\Http\Helper\DataFormatter\User\UserFormatter;
use App\Http\Helper\DingFacade\Ding;
use App\Http\Helper\DingFacade\DingFacade;
use App\Http\Helper\HelperClass;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{

    /**
     * Method to test new things
     * @param Request $request
     */
    public function testing(Request $request){
        $data = [
            'SkuCode'    => 'CU_CU_TopUp',
            'SendValue'  =>  20,
            'SendCurrencyIso' => 'USD',
            'AccountNumber' => '54906369',
            'DistributorRef'=> 'Stay Connect',
            'ValidateOnly' =>  True
        ];

        $header = [
            "api_key:LFg2ydkqyU9634Qqa3iUyp",
            'Content-Type:application/json',
        ];


        $send = Ding::sendTransferToAnAccount($header,$data);
        dd($send);
    }
}
