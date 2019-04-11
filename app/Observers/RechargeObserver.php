<?php

namespace App\Observers;

use App\Contact;
use App\NautaRecharge;
use App\Recharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RechargeObserver
{
    /**
     * Handle the recharge "created" event.
     * @param  \App\Recharge  $recharge
     * @return void
     */
    public function created(Recharge $recharge)
    {
        $recharge->load('child');
        if($recharge->child instanceof NautaRecharge){
            $exits_contact = Contact::where('email', $recharge->child->email)->first();
        } else {
            $exits_contact = Contact::where('number',$recharge->child->number)->first();
        }

        if(!$exits_contact){
            try{
                $data = $this->handleData($recharge);
                $contact = Contact::create($data);
                if(!$contact){
                    throw new \Exception('Error creating the Contact');
                }
                $recharge->contact_id = $contact->id;
                $recharge->save();
            } catch(\Exception $e) {
                Log::info($e->getMessage());
            }
        }  else {
            $recharge->contact_id = $exits_contact->id;
            $recharge->save();
        }
    }

    private function handleData($recharge){
        if($recharge->child instanceof NautaRecharge){
            return [
                'name'      => '',
                'email'     => $recharge->child->email,
                'image'     => '',
                'number'    => '' ,
                'user_id'   => Auth::user()->id
            ];
        }
        return [
                'name'      => '',
                'email'     => '',
                'image'     => '',
                'number'    => $recharge->child->number,
                'user_id'   => Auth::user()->id
        ];
    }
    /**
     * Handle the recharge "updated" event.
     *
     * @param  \App\Recharge  $recharge
     * @return void
     */
    public function updated(Recharge $recharge)
    {
        //
    }

    /**
     * Handle the recharge "deleted" event.
     *
     * @param  \App\Recharge  $recharge
     * @return void
     */
    public function deleted(Recharge $recharge)
    {
        //
    }

    /**
     * Handle the recharge "restored" event.
     *
     * @param  \App\Recharge  $recharge
     * @return void
     */
    public function restored(Recharge $recharge)
    {
        //
    }

    /**
     * Handle the recharge "force deleted" event.
     *
     * @param  \App\Recharge  $recharge
     * @return void
     */
    public function forceDeleted(Recharge $recharge)
    {
        //
    }
}
