<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketStatus::create([
            'state' => 'New',
        ]);

        TicketStatus::create([
            'state' => 'In progress',
        ]);

        TicketStatus::create([
            'state' => 'Completed',
        ]);
        
    }
}
