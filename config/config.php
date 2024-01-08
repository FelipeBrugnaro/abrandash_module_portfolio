<?php

return [
    'name' => 'Portfolio',

    'routes' => [
        'index'   => 'admin.site_portfolio.index',
        'edit'    => 'admin.site_portfolio.edit',
        'create'  => 'admin.site_portfolio.create',

        'store'  => 'admin.site_portfolio.store',
        'update' => 'admin.site_portfolio.update',
        'delete' => 'admin.site_portfolio.destroy',
    ]
];