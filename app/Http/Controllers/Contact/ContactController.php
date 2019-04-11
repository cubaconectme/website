<?php

namespace App\Http\Controllers\Contact;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Helper\ControllerHelper\RechargesHelpers\RechargesHelper;
use App\Http\Helper\DataFormatter\Contacts\ContactsFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function actions(Request $request)
    {

    }

    /**
     * Generic contact edit
     * @param Request $request
     * @return array
     */
    public function editContact(Request $request){
        if($request->entity_id && $request->attribute && $request->value){
            $contact = Contact::where('id',$request->entity_id)->first();
            if(!$contact){
                return ['has_error' => true, 'error_message' => 'Ese contacto ya no existe'];
            }
            $contact->{$request->attribute} = $request->value;
            $contact->save();
            return ['has_error' => false, 'error_message' => 'Contacto editado correctamente', 'data' => ['contact' => $contact]];

        } else {
            return ['has_error' => true, 'error_message' => 'Error en la peticion'];
        }
    }
}
