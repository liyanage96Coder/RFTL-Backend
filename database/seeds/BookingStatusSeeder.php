<?php

use App\BookingStatus;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookingStatus::create([
            'active' => true,
            'user_id' => 1,
        ]);
    }
}
