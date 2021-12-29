<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendeur;

class VendeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendeur::factory()
            ->count(5)
            ->create();
    }
}
