<?php

namespace Thoughtco\StatamicCpResources;

use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    public function boot()
    {
        parent::boot();

        $this->mergeConfigFrom(__DIR__.'/../config/client-dashboard.php', 'thoughtco.client-dashboard');
        
        $this->publishes([
            __DIR__.'/../config/client-dashboard.php' => config_path('thoughtco/client-dashboard.php'),
        ], 'client-dashboard-config');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'statamic-cp-resources');

        Statamic::booted(function () {
            Nav::extend(function ($nav) {
                $nav->content(config('statamic.cp-resources.nav.title', 'Resources'))
                    ->section(config('statamic-cp-resources.nav.section', 'Thought Collective'))
                    ->route('cp-resources.index')
                    ->icon('pin')
                    ->can('view resources');
            });

            Permission::register('view '.strtolower(config('thoughtco.client-dashboard.nav.title')))
                ->label('View '.config('thoughtco.client-dashboard.nav.title'));
        });
    }
}
