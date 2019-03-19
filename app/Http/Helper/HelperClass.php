<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 3/7/2019
 * Time: 10:11 AM
 */

namespace App\Http\Helper;

use stdClass;

class HelperClass
{
    public static function vueSelect($array){
        $vue = collect();
        if (count($array)) {
            foreach ($array as $key => $value) {
                $aux = new stdClass();
                $aux->id = $key;
                $aux->text = $value;
                $vue->push($aux);
            }
        }
        return $vue;
    }
}