<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helper\BreadCrumbs\Admin\UserBreadCrumbs;
use App\Http\Helper\ControllerHelper\UserHelper\UserHelper;
use App\Http\Helper\DataFormatter\User\UserFormatter;
use App\Http\Helper\HelperClass;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
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
     * @return array
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $this->breadcrumbs->addItemToBreadCrumbs('2','User',URL::route('user.index'));
        $users = User::withTrashed()->with('roles')->get();
        $roles = HelperClass::vueSelect(Role::pluck('name','id'));
        $users->transform(function($user){
            return new UserFormatter($user);
        });
        return ['has_error' => false, 'error_message' => 'User Loaded Successfully','data' => ['user' => $users, 'roles' => $roles,'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()]];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function actions(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $this->breadcrumbs->addItemToBreadCrumbs('2','User',URL::route('user.action'));
        $user = new UserHelper($request);
        if(!$user) {
            return ['has_error' => true, 'error_message' => 'Error Handling this Product','data' => []];
        }
        if($user->has_error) {
           return ['has_error' => true, 'error_message' => $user->error_message,'data' => []];
        }

        return ['has_error' => false, 'error_message' => $user->error_message ? : 'Action was successfully' ,'data' => ['user' => $user->user_edited, 'breadcrumbs' => $this->breadcrumbs->getBreadCrumbs()]];
    }
}
