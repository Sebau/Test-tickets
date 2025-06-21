<?php

namespace Database\Seeders;

use App\Models\ModelOfTransport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeOfTransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelOfTransport::create([
            'name_mode_of_transport' => 'Air',
        ]);

        ModelOfTransport::create([
            'name_mode_of_transport' => 'Land',
        ]);

        ModelOfTransport::create([
            'name_mode_of_transport' => 'Sea',
        ]);
    }
}
