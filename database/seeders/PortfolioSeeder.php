<?php

namespace Modules\Portfolio\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\{Menu, Permission};

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $portfolio = Menu::create([
            'title'  => 'portfolio::lang',
            'pai'    => 4,
            'code'   => 'site_portfolio',
            'route'  => 'admin.site_portfolio.index',
            'icon'   => 'images',
            'module' => 'Portfolio',
            'order'  => 5,
            'status' => true
        ]);

        $permissions = Permission::insert([
            ['title' => 'CREATE_PORTFOLIO', 'module' => 'Portfolio'],
            ['title' => 'EDIT_PORTFOLIO', 'module' => 'Portfolio'],
            ['title' => 'DELETE_PORTFOLIO', 'module' => 'Portfolio'],
        ]);
    }
}
