<?php

namespace Database\Seeders;

use App\Models\CyclingClub;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CyclingClubSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CyclingClub::insert([
            [
                'club_name' => 'Red Ride', 'bio' => '','stock' => 5, 'is_active'=> 1, 
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'club_name' => 'Purple Ride', 'bio'   => '','stock' => 1, 'is_active'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'club_name' => 'Green Ride', 'bio'   => '','stock' => 0, 'is_active'=> 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]    
        ]);
    }
}
