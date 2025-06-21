<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       TicketType::create([
            'type' => '1',
        ]);

        TicketType::create([
            'type' => '2',
        ]);

        TicketType::create([
            'type' => '3',
        ]);

    }
}
