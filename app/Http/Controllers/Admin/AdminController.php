<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helper\BreadCrumbs\Admin\UserBreadCrumbs;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $breadcrumbs;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->breadcrumbs = new UserBreadCrumbs();
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('admin.index')->withBreadcrumbs($this->breadcrumbs->getBreadCrumbs());
    }
}
