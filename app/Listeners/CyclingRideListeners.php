<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use App\Models\CyclingClub;
use App\Models\UserCyclingClub;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CyclingRideListeners
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserRegisterEvent  $event
     * @return void
     */
    public function handle(UserRegisterEvent $event)
    {
       $cyclingClub = CyclingClub::findOrfail($event->ride_id);
       $user_cycling  = new UserCyclingClub();
       $user_cycling->user_id = $event->user->id;
       $user_cycling->cycling_club_id = $event->ride_id;
       if($cyclingClub->stock > 0){
        $user_cycling->status = 1;
        $cyclingClub->stock = $cyclingClub->stock - 1;
       }else{
        $user_cycling->status = 0;
       }
       if($user_cycling->save()){
        $cyclingClub->save();
       }

    }
}
