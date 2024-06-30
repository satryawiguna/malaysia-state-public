<?php

namespace FreshCMS\MalaysiaState\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class MalaysiaStateSeeder extends Seeder
{
    public function run()
    {
        Artisan::call('malaysia-state:import');
    }
}
