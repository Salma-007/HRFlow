<?php

namespace Database\Seeders;

use App\Models\Conge;
use Illuminate\Database\Seeder;

class CongesSeeder extends Seeder
{
    /**
     * Exécuter le seeder.
     *
     * @return void
     */
    public function run()
    {
        Conge::factory(10)->create();
    }
}
