<?php

namespace Thoughtco\StatamicCpresources;

use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    
    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    public function bootAddon()
    {                
        $this->mergeConfigFrom(__DIR__.'/../config/client-dashboard.php', 'thoughtco.client-dashboard');

        $this->publishes([
            __DIR__.'/../config/client-dashboard.php' => config_path('thoughtco/client-dashboard.php'),
        ], 'client-dashboard-config');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'thoughtco-cpresources');

        Nav::extend(function ($nav) {
            $nav->content(config('thoughtco.client-dashboard.nav.title', 'Resources'))
                ->section(config('thoughtco.client-dashboard.nav.section', 'Thought Collective'))
                ->route('cpresources.index')
                ->icon('pin')
                ->can('view resources');
        });

        Permission::register('view '.strtolower(config('thoughtco.client-dashboard.nav.title')))
            ->label('View '.config('thoughtco.client-dashboard.nav.title'));

    }
}
