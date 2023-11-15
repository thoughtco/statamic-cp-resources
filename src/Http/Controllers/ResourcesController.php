<?php

namespace Thoughtco\StatamicCpResources\Http\Controllers;

use Statamic\Facades\User;
use Statamic\Http\Controllers\CP\CpController;

class ResourcesController extends CpController
{
    public function __invoke()
    {        
        if (! User::current()->can('view '.strtolower(config('thoughtco.client-dashboard.nav.title')))) {
            abort(403);
        }

        return view('statamic-cpresources::index', [
            'trelloUrl' => config('client-dashboard.trello_url'),
            'looms' => config('client-dashboard.looms'),
            'additionalResources' => config('client-dashboard.additional_resources'),
        ]);
    }
}
