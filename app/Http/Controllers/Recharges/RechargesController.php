<?php

namespace App\Http\Controllers\Recharges;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Helper\ControllerHelper\RechargesHelpers\RechargesHelper;
use App\Http\Helper\DataFormatter\Contacts\ContactsFormatter;
use App\Http\Helper\DataFormatter\Planes\PlanesFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RechargesController extends Controller
{
    private $breadcrumbs;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     * @param Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        $request->user()->authorizeRoles(['admin','customer']);
        $recharge = new RechargesHelper($request);

        if(!$recharge) {
            return ['has_error' => true, 'error_message' => 'Error Handling this Product','data' => []];
        }
        return ['has_error' => false, 'error_message' => 'Action was successfully','data' => ['recharges' => $recharge->recharges, 'contact' => new ContactsFormatter($recharge->contact)]];
    }

    /**
     * Get Cubacel Contacts
     * @param Request $request
     * @param $query
     * @param $limit
     * @return array
     */
    public function getCubacelContacts(Request $request,$query,$limit){
        $request->user()->authorizeRoles(['admin','customer']);
        $user = Auth::user();
        $contacts = Contact::where('user_id', $user->id)->where(function($filter) use($query){
            $filter->where('name','LIKE','%'.$query.'%')
                   ->orWhere('number','LIKE', '%'.$query.'%');
        })->orderBy('id','DESC')->limit($limit)->get();


        $contacts->transform(function($product){
            return new ContactsFormatter($product);
        });

        return ['has_error' => false, 'error_message' => 'Product Loaded Successfully', 'result' => $contacts];
    }

    /**
     * Get Cubacel Contacts
     * @param Request $request
     * @param $query
     * @param $limit
     * @return array
     */
    public function getNautaContacts(Request $request,$query,$limit){
        $request->user()->authorizeRoles(['admin','customer']);
        $user = Auth::user();
        $contacts = Contact::where('user_id', $user->id)->where(function($filter) use($query){
            $filter->where('name','LIKE','%'.$query.'%')
                ->orWhere('number','LIKE', '%'.$query.'%')
                ->orWhere('email','LIKE', '%'.$query.'%');
        })->orderBy('id','DESC')->limit($limit)->get();


        $contacts->transform(function($product){
            return new ContactsFormatter($product);
        });

        return ['has_error' => false, 'error_message' => 'Product Loaded Successfully', 'result' => $contacts];
    }

}
