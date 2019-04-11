<?php
/**
 * Created by PhpStorm.
 * User: Vane-Meli
 * Date: 4/10/2019
 * Time: 8:33 AM
 */

namespace App\Http\Helper\DingFacade;


class DingMethods
{
    private $base_url;

    private $api_key;

    private $cUrl_response;

    private $cUrl_errors;

    private $headers;
    /**
     * Init Principal var to start Ding Connection
     * Ding constructor.
     */
    public function __construct(){
        $this->base_url = env('DING_BASE_API_URL');
        $this->api_key = env('DING_KEY');
        $this->initHeaders();
    }

    /**
     * Method to init headers request
     * @return array
     */
    private function initHeaders(){
        $this->headers =  [
            'api_key:'.$this->api_key,
            'Content-Type:application/json'
        ];
    }


    /**
     * Get a list of error code descriptions
     * @return array
     */
    public function getErrorCode(){
        $url = $this->base_url.''.'/api/V1/GetErrorCodeDescriptions';
        return $this->handleResponse($url);
    }

    /**
     * Get Currencies
     * @return array
     */
    public function getCurrencies(){
        $url = $this->base_url.''.'/api/V1/GetCurrencies';
        return $this->handleResponse($url);
    }

    /**
     * Get Regions
     * @param null $country
     * @return array
     */
    public function getRegions($country = null){
        $url = ($country) ?  $this->base_url.''.'/api/V1/GetRegions?countryIsos='.$country : $this->base_url.''.'/api/V1/GetRegions';
        return $this->handleResponse($url);
    }

    /**
     * Get Supported Countries
     * @return array
     */
    public function getSupportedCountries(){
        $url = $this->base_url.''.'/api/V1/GetCountries';
        return $this->handleResponse($url);
    }

    /**
     * Get Avaible products by providers
     * @param null $providers_code
     * @param null $country_iso
     * @param null $region_code
     * @param null $account_number
     * @return array
     */
    public function getAvailableProductProviders($providers_code = null, $country_iso = null, $region_code = null, $account_number = null){
        $url = $this->base_url.''.'/api/V1/GetProviders';
        if($providers_code){
            $url  .= '?providerCodes='.$providers_code;
        }

        if($country_iso){
            $url .= '?countryIsos='.$country_iso;
        }

        if($region_code){
            $url .= '?regionCodes='.$region_code;
        }

        if($account_number){
            $url .= '?accountNumber='.$account_number;
        }
        return $this->handleResponse($url);
    }

    /**
     * Get the Product Provider Status
     * @param null $provider_code
     * @return array
     */
    public function getProductProviderStatus($provider_code = null){
        $url = $this->base_url.'/api/V1/GetProviderStatus';
        if($provider_code){
            $url = $this->base_url.''.'/api/V1/GetProviderStatus?providerCodes='.$provider_code;
        }
        return $this->handleResponse($url);
    }

    /**
     * Get products to use in Transfer
     * @return array
     */
    public function getProductsToUseInTransfer($country_isos = null, $provider_codes = null, $sku_codes = null, $benefits = null, $region_codes = null, $account_number = null){
        $url = $this->base_url.'/api/V1/GetProducts';
        if($country_isos){
            $url .= '?countryIsos='.$country_isos;
        }
        if($provider_codes){
            $url .= '?providerCodes='.$provider_codes;
        }
        if($sku_codes){
            $url .= '?skuCodes='.$sku_codes;
        }
        if($benefits){
            $url .= '?benefits='.$benefits;
        }
        if($region_codes){
            $url .= '?regionCodes='.$region_codes;
        }
        if($account_number){
            $url .= '?accountNumber='.$account_number;
        }
        return $this->handleResponse($url);
    }

    /**
     * Get the localization for products
     * @param $language_codes
     * @param $sku_codes
     * @return array
     */
    public function getLocalizedStringForProducts($language_codes = null,$sku_codes= null){
        $url = $this->base_url.'/api/V1/GetProductDescriptions';
        if($language_codes){
            $url .= '?languageCodes='.$language_codes;
        }
        if($sku_codes){
            $url .= '?skuCodes='.$sku_codes;
        }
        return $this->handleResponse($url);
    }

    /**
     * Get Agent Current Balance
     * @return array
     */
    public function getCurrentAgentBalance(){
        $url = $this->base_url.'/api/V1/GetBalance';
        $this->cUrl_response = $this->makeGetCurl($url);
        if($this->cUrl_response->ResultCode === 1){
            return ['has_error' => false, 'error_message' => 'Action was Successfully', 'data' => ['balance' => $this->cUrl_response->Balance, 'currency' => $this->cUrl_response->CurrencyIso]];
        } else {
            return ['has_error' => true, 'error_message' => 'Error Connecting with Ding', 'data' => $this->cUrl_response->ErrorCodes];
        }
    }

    /**
     * Get List of promotions
     * @param null $country_isos
     * @param null $provider_codes
     * @param $account_number
     * @return array
     */
    public function getListOfPromotions($country_isos = null, $provider_codes = null, $account_number = null){
        $url = $this->base_url.'/api/V1/GetPromotions';
        if($country_isos){
            $url .= '?countryIsos='.$country_isos;
        }
        if($provider_codes){
            $url .= '?providerCodes='.$provider_codes;
        }
        if($account_number){
            $url .= '?accountNumber='.$account_number;
        }
        return $this->handleResponse($url);
    }

    /**
     * Get string for promotions
     * @param null $language_codes
     * @return array
     */
    public function getLocalizedStringForPromotions($language_codes = null){
        $url = $this->base_url.'/api/V1/GetPromotionDescriptions';
        if($language_codes){
            $url .= '?languageCodes='.$language_codes;
        }
        return $this->handleResponse($url);
    }

    /**
     * Get Provider and product information
     * @param null $account_number
     * @return array
     */
    public function getProviderAndProductInformation($account_number){
        $url = $this->base_url.'/api/V1/GetAccountLookup';
        if($account_number) {
            $url .= '?accountNumber='.$account_number;
        }
        return $this->handleResponse($url);
    }

    /**
     * Handle Response
     * @param $url
     * @return array
     */
    private function handleResponse($url){
        $this->cUrl_response = $this->makeGetCurl($url);
        if($this->cUrl_response->ResultCode === 1){
            return ['has_error' => false, 'error_message' => 'Action was Successfully', 'data' => $this->cUrl_response->Items];
        } else {
            return ['has_error' => true, 'error_message' => 'Error Connecting with Ding', 'data' => $this->cUrl_response->ErrorCodes];
        }
    }

    /**
     * Send Recharge
     * @param null $headers
     * @param null $data
     * @return array
     */
    public function sendTransferToAnAccount($headers = null, $data = null){
        $url = $this->base_url.'/api/V1/SendTransfer';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $this->cUrl_response = json_decode($response);
        $error = curl_error($ch);
        curl_close($ch);
        if($this->cUrl_response->ResultCode === 1){
            return ['has_error' => false, 'error_message' => 'Action was Successfully', 'data' => $this->cUrl_response->TransferRecord];
        } else {
            return ['has_error' => true, 'error_message' => 'Error Connecting with Ding', 'data' => $this->cUrl_response->ErrorCodes];
        }
    }



    /**
     *
     * @param $url
     * @return mixed
     */
    private function makeGetCurl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $cUrl_response = json_decode($response);
        $cUrl_errors = curl_error($ch);
        curl_close($ch);

        return $cUrl_response;
    }
}