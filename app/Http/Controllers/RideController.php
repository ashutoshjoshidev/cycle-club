<?php

namespace App\Http\Controllers;

use App\Models\CyclingClub;
use App\Models\UserCyclingClub;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function getRideCount($id)
    {
        $this->rideValidate($id);
        return UserCyclingClub::where('cycling_club_id',$id)->where('status',1)->count();
    }

    public function getWaitlistCount($id)
    {
        $this->rideValidate($id);
        return UserCyclingClub::where('cycling_club_id',$id)->where('status',0)->count();
    }

    public function rideValidate($id)
    {
        CyclingClub::findOrFail($id);
    }
}
