<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/10/2019
 * Time: 9:21 AM
 */

namespace App\Http\Helper\DingFacade;


use Illuminate\Support\Facades\Facade;

class Ding extends Facade
{
    protected static function getFacadeAccessor() { return 'ding'; }
}