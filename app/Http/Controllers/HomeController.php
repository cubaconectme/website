<?php

namespace App\Http\Controllers;

use App\Http\Helper\ControllerHelper\HomeHelper\HomeViewHelper;
use App\Http\Helper\ControllerHelper\UserHelper\HomeHelper;
use App\Http\Helper\DataFormatter\Product\ProductFormatter;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => 'indexView']);
    }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['customer', 'dealer', 'admin']);
        $helper = (new HomeHelper($request))->toArray();
        return view('home')->with($helper);
    }

    /**
     * Home Controller a Portada
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexView(){

        $home_data = new HomeViewHelper();
        return view('welcome')->with($home_data->toArray());
    }
}
