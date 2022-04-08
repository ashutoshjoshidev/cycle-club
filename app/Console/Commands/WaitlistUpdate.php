<?php

namespace App\Console\Commands;

use App\Models\CyclingClub;
use App\Models\UserCyclingClub;
use Illuminate\Console\Command;
use PDO;

class WaitlistUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'waitlist:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating waitlist user if stock available.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user_waitlist = UserCyclingClub::where('status',0)->get();
        if(count($user_waitlist) > 0){
            $cycling_clubs = CyclingClub::where('stock','>',0)->get(); 
            if(count($cycling_clubs) > 0){
                foreach($cycling_clubs as $club){
                    $clubusers = UserCyclingClub::where('status',0)->where('cycling_club_id',$club->id)->take($club->stock)->pluck('user_id')->toArray();
                    if(count($clubusers)>0){
                        UserCyclingClub::whereIn('user_id', $clubusers)->where('cycling_club_id',$club->id)->update(['status' => 1]);
                        $club->stock =  $club->stock - count($clubusers);
                        $club->save();
                    }
                }
            }
        }
    }
}
