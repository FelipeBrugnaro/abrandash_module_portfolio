<?php

namespace Modules\Portfolio\database\seeders;

use Illuminate\Database\Seeder;

class PortfolioDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PortfolioSeeder::class
        ]);
    }
}
