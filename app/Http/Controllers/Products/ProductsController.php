<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Helper\BreadCrumbs\Admin\ProductBreadCrumbs;
use App\Http\Helper\ControllerHelper\ProductHelper\ProductHelper;
use App\Http\Helper\DataFormatter\Product\ProductFormatter;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProductsController extends Controller
{
    private $breadcrumbs;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = new ProductBreadCrumbs();
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
        $this->breadcrumbs->addItemToBreadCrumbs('2','Products',URL::route('products.index'));
        $products = Product::get();
        $products->transform(function($product){
            return new ProductFormatter($product);
        });
        return ['has_error' => false, 'error_message' => 'Product Loaded Successfully','data' => ['products' => $products, 'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()]];
    }


    /**
     * Show the application dashboard.
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $this->breadcrumbs->addItemToBreadCrumbs('2','Products',URL::route('products.index'));
        $product = new ProductHelper($request);

        if(!$product) {
            return ['has_error' => true, 'error_message' => 'Error Handling this Product','data' => []];
        }
        return ['has_error' => false, 'error_message' => 'Action was successfully','data' => ['product' => $product->product, 'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()]];
    }
}
