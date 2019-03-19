<?php

namespace App\Http\Controllers\Promotions;

use App\Http\Controllers\Controller;
use App\Http\Helper\BreadCrumbs\Admin\ProductBreadCrumbs;
use App\Http\Helper\BreadCrumbs\Admin\PromotionsBreadCrumbs;
use App\Http\Helper\ControllerHelper\ProductHelper\ProductHelper;
use App\Http\Helper\ControllerHelper\PromotionHelper\PromotionHelper;
use App\Http\Helper\DataFormatter\Product\ProductFormatter;
use App\Http\Helper\DataFormatter\Promotion\PromotionFormatter;
use App\Planes;
use App\Product;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PromotionsController extends Controller
{
    private $breadcrumbs;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = new PromotionsBreadCrumbs();
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $this->breadcrumbs->addItemToBreadCrumbs('2','Promotions',URL::route('products.index'));
        $promotion = Promotion::with('plan')->get();
        $planes = Planes::pluck('name','id');
        $promotion->transform(function($promo){
            return new PromotionFormatter($promo);
        });
        return [
            'has_error' => false,
            'error_message' => 'Product Loaded Successfully',
            'data' => [
                'promotions' => $promotion,
                'planes' => $planes,
                'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()
            ]
        ];
    }


    /**
     * Show the application dashboard.
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $this->breadcrumbs->addItemToBreadCrumbs('2','Promotions',URL::route('products.index'));
        $promotion = new PromotionHelper($request);

        if(!$promotion) {
            return ['has_error' => true, 'error_message' => 'Error Handling this Product','data' => []];
        }
        return ['has_error' => false, 'error_message' => 'Action was successfully','data' => ['promotion' => $promotion->promotion, 'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()]];
    }
}
