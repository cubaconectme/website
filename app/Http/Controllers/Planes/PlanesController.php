<?php

namespace App\Http\Controllers\Planes;

use App\Http\Controllers\Controller;
use App\Http\Helper\BreadCrumbs\Admin\PlanesBreadCrumbs;
use App\Http\Helper\ControllerHelper\PlanHelper\PlanHelper;
use App\Http\Helper\ControllerHelper\PlanHelper\PromotionHelper;
use App\Http\Helper\DataFormatter\Planes\PlanesFormatter;
use App\Planes;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PlanesController extends Controller
{
    private $breadcrumbs;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = new PlanesBreadCrumbs();
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
        $this->breadcrumbs->addItemToBreadCrumbs('2','Planes',URL::route('planes.index'));
        $products = Product::pluck('name', 'id');
        $planes = Planes::with('product')->get();
        $planes->transform(function($plan){
            return new PlanesFormatter($plan);
        });
        return [
            'has_error' => false,
            'error_message' => 'Planes Loaded Successfully',
            'data' => [
                'planes' => $planes,
                'products' => $products,
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
        $this->breadcrumbs->addItemToBreadCrumbs('2','Planes',URL::route('planes.index'));
        $plan = new PlanHelper($request);

        if(!$plan) {
            return ['has_error' => true, 'error_message' => 'Error Handling this plan','data' => []];
        }
        return ['has_error' => false, 'error_message' => 'Action was successfully','data' => ['plan' => $plan->plan, 'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()]];
    }
}
